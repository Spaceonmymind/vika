<?php

namespace Modules\BusinessSupportWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetMeasure;

class BusinessSupportWidgetService {

    public function getMeasures(array $filters=[])
    {
        return BusinessSupportWidgetMeasure::query()
            ->select([
                'id',
                'name',
                'description',
                'conditions',
                'activities',
                'financial_support',
                'terms',
                'law',
                'revenue_year',
                'company_age',
                'documents',
                'date_receipt_documents',
                'employees',
                'contacts',
                'situation_id',
                'subject_id',
                'registration_place_id',
                'support_organisation_id',
                'support_type_id',
            ])
            ->with([
                'business_support_widget_registration_place',
                'business_support_widget_situation',
                'business_support_widget_subject',
                'business_support_widget_support_organisation',
                'business_support_widget_support_type',
            ])
            ->when(isset($filters['situation_id']), function (Builder $q) use ($filters) {
                $q->where('situation_id', $filters['situation_id']);
            })
            ->when(isset($filters['subject_id']), function (Builder $q) use ($filters) {
                $q->where('subject_id', $filters['subject_id']);
            })
            ->when(isset($filters['support_type_id']), function (Builder $q) use ($filters) {
                $q->where('support_type_id', $filters['support_type_id']);
            })
            ->when(isset($filters['support_organisation_id']), function (Builder $q) use ($filters) {
                $q->where('support_organisation_id', $filters['support_organisation_id']);
            })
            ->when(isset($filters['registration_place_id']), function (Builder $q) use ($filters) {
                $q->where('registration_place_id', $filters['registration_place_id']);
            })
            ->cursorPaginate(30);
    }
}
