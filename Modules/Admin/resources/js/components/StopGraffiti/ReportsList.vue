<template>
  <div class="stop-graffiti">
    <div class="white-box filters">
      <el-input
        v-model="filters.query"
        clearable
        placeholder="Номер, адрес или комментарий"
        @keyup.enter="loadReports(1)"
        @clear="loadReports(1)"
      />
      <el-select v-model="filters.status" clearable placeholder="Статус" @change="loadReports(1)">
        <el-option
          v-for="status in metadata.statuses"
          :key="status.value"
          :label="status.label"
          :value="status.value"
        />
      </el-select>
      <el-select v-model="filters.category" clearable placeholder="Категория" @change="loadReports(1)">
        <el-option v-for="category in metadata.categories" :key="category" :label="category" :value="category"/>
      </el-select>
      <el-button type="primary" @click="loadReports(1)">Найти</el-button>
    </div>

    <div class="white-box table-box">
      <el-table v-loading="loading" :data="reports" stripe @row-click="openReport">
        <el-table-column prop="external_id" label="Номер" min-width="190"/>
        <el-table-column label="Дата" min-width="155">
          <template #default="{ row }">{{ formatDate(row.reported_at) }}</template>
        </el-table-column>
        <el-table-column prop="category" label="Категория" min-width="170"/>
        <el-table-column prop="address" label="Адрес" min-width="260" show-overflow-tooltip/>
        <el-table-column label="Статус" width="140">
          <template #default="{ row }">
            <el-tag :type="statusType(row.status)">{{ statusLabel(row.status) }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Исполнитель" min-width="150">
          <template #default="{ row }">{{ row.assignee?.name || 'Не назначен' }}</template>
        </el-table-column>
      </el-table>
    </div>

    <div class="white-box pagination-box">
      <el-pagination
        v-model:current-page="pagination.current_page"
        v-model:page-size="pagination.per_page"
        :total="pagination.total"
        :page-sizes="[15, 30, 50, 100]"
        layout="total, sizes, prev, pager, next"
        background
        @current-change="loadReports"
        @size-change="loadReports(1)"
      />
    </div>

    <el-drawer v-model="drawer" size="min(720px, 96%)" title="Обращение">
      <div v-if="selected" v-loading="saving" class="report-detail">
        <div class="report-heading">
          <h2>{{ selected.external_id }}</h2>
          <el-tag :type="statusType(selected.status)">{{ statusLabel(selected.status) }}</el-tag>
        </div>
        <el-descriptions :column="1" border>
          <el-descriptions-item label="Получено">{{ formatDate(selected.reported_at) }}</el-descriptions-item>
          <el-descriptions-item label="Категория">{{ selected.category }}</el-descriptions-item>
          <el-descriptions-item label="Адрес">{{ selected.address }}</el-descriptions-item>
          <el-descriptions-item label="Комментарий">{{ selected.comment || 'Нет' }}</el-descriptions-item>
          <el-descriptions-item label="MAX ID">{{ selected.max_user_id }}</el-descriptions-item>
        </el-descriptions>

        <h3>Материалы</h3>
        <div v-if="selected.media?.length" class="media-grid">
          <a
            v-for="media in selected.media"
            :key="media.id"
            :href="media.preview_url || '#'"
            target="_blank"
            rel="noopener noreferrer"
            class="media-card"
            @click="!media.preview_url && $event.preventDefault()"
          >
            <el-image
              v-if="media.type === 'image' && media.preview_url"
              :src="media.preview_url"
              fit="cover"
            />
            <span v-else-if="media.load_error">Ошибка загрузки материала</span>
            <span v-else>Загрузка материала…</span>
          </a>
        </div>
        <el-empty v-else description="Материалы отсутствуют"/>

        <h3>Обработка</h3>
        <el-form label-position="top">
          <el-form-item label="Статус">
            <el-select v-model="edit.status" style="width: 100%">
              <el-option
                v-for="status in metadata.statuses"
                :key="status.value"
                :label="status.label"
                :value="status.value"
              />
            </el-select>
          </el-form-item>
          <el-form-item label="Исполнитель">
            <el-select v-model="edit.assigned_to" clearable style="width: 100%">
              <el-option
                v-for="operator in metadata.operators"
                :key="operator.id"
                :label="operator.name"
                :value="operator.id"
              />
            </el-select>
          </el-form-item>
          <el-form-item label="Комментарий к изменению статуса">
            <el-input v-model="edit.comment" type="textarea" :rows="3"/>
          </el-form-item>
          <el-button type="primary" @click="saveReport">Сохранить</el-button>
        </el-form>

        <h3>История</h3>
        <el-timeline>
          <el-timeline-item
            v-for="item in selected.status_history"
            :key="item.id"
            :timestamp="formatDate(item.created_at)"
          >
            {{ statusLabel(item.from_status) }} → {{ statusLabel(item.to_status) }}
            <div v-if="item.comment">{{ item.comment }}</div>
            <small>{{ item.changed_by?.name || 'Система' }}</small>
          </el-timeline-item>
        </el-timeline>
      </div>
    </el-drawer>
  </div>
</template>

<script>
import moment from 'moment';

export default {
  name: 'StopGraffitiReportsList',
  data() {
    return {
      loading: false,
      saving: false,
      drawer: false,
      reports: [],
      selected: null,
      mediaObjectUrls: [],
      filters: {query: null, status: null, category: null},
      metadata: {statuses: [], categories: [], operators: []},
      pagination: {current_page: 1, per_page: 15, total: 0},
      edit: {status: null, assigned_to: null, comment: null},
    };
  },
  async mounted() {
    await Promise.all([this.loadMetadata(), this.loadReports()]);
  },
  beforeUnmount() {
    this.revokeMediaObjectUrls();
  },
  methods: {
    async loadMetadata() {
      const {data} = await this.$axios.get('/api/admin/stop-graffiti/metadata');
      this.metadata = data;
    },
    async loadReports(page = this.pagination.current_page) {
      this.loading = true;
      try {
        const params = {
          ...this.filters,
          page,
          per_page: this.pagination.per_page,
        };
        const {data} = await this.$axios.get('/api/admin/stop-graffiti/reports', {params});
        this.reports = data.data;
        this.pagination = {
          current_page: data.current_page,
          per_page: data.per_page,
          total: data.total,
        };
      } finally {
        this.loading = false;
      }
    },
    async openReport(row) {
      this.revokeMediaObjectUrls();
      const {data} = await this.$axios.get(`/api/admin/stop-graffiti/reports/${row.id}`);
      this.selected = data;
      this.edit = {
        status: data.status,
        assigned_to: data.assigned_to,
        comment: null,
      };
      this.drawer = true;
      await this.loadMedia(data.media || []);
    },
    async loadMedia(mediaItems) {
      await Promise.all(mediaItems.map(async media => {
        if (!media.download_url) {
          return;
        }

        try {
          const {data} = await this.$axios.get(media.download_url, {responseType: 'blob'});
          media.preview_url = URL.createObjectURL(data);
          this.mediaObjectUrls.push(media.preview_url);
        } catch {
          media.load_error = true;
        }
      }));
    },
    revokeMediaObjectUrls() {
      this.mediaObjectUrls.forEach(url => URL.revokeObjectURL(url));
      this.mediaObjectUrls = [];
    },
    async saveReport() {
      this.saving = true;
      try {
        const {data} = await this.$axios.patch(
          `/api/admin/stop-graffiti/reports/${this.selected.id}`,
          this.edit,
        );
        this.selected = data;
        this.edit.comment = null;
        await this.loadReports();
        ElMessage.success('Обращение обновлено');
      } finally {
        this.saving = false;
      }
    },
    statusLabel(value) {
      if (!value) {
        return 'Создано';
      }
      return this.metadata.statuses.find(status => status.value === value)?.label || value;
    },
    statusType(value) {
      return {new: 'danger', in_progress: 'warning', completed: 'success', rejected: 'info'}[value] || '';
    },
    formatDate(value) {
      return value ? moment(value).format('DD.MM.YYYY HH:mm') : '';
    },
  },
};
</script>

<style scoped>
.filters {
  display: grid;
  grid-template-columns: minmax(240px, 2fr) minmax(160px, 1fr) minmax(180px, 1fr) auto;
  gap: 12px;
  margin-bottom: 20px;
}
.report-heading {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.media-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  gap: 12px;
}
.media-card {
  min-height: 120px;
  border: 1px solid #e4e7ed;
  border-radius: 8px;
  overflow: hidden;
}
.media-card .el-image {
  width: 100%;
  height: 160px;
}
@media (max-width: 800px) {
  .filters {
    grid-template-columns: 1fr;
  }
}
</style>
