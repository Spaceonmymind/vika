<?php

namespace Modules\InformationSystemsWidget\Services;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Modules\InformationSystemsWidget\Models\InformationSystem;

class InformationSystemsWidgetService
{
    public function getListOfInformationSystems(?int $ownerId, ?int $operatorId, ?int $purposeId, ?string $name): CursorPaginator
    {
        return InformationSystem::query()
            ->with(['purposes', 'subsystems', 'owner', 'operator'])
            ->when(isset($ownerId), function (Builder $q) use ($ownerId) {
                $q->where('owner_id', $ownerId);
            })
            ->when(isset($operatorId), function (Builder $q) use ($operatorId) {
                $q->where('operator_id', $operatorId);
            })
            ->when(isset($purposeId), function (Builder $q) use ($purposeId) {
                $q->whereHas('purposes', function (Builder $q) use ($purposeId) {
                    $q->where('purpose_id', $purposeId);
                });
            })
            ->when(isset($name), function (Builder $q) use ($name) {
                $q->where('full_name', 'like', '%' . $name . '%')
                    ->orWhere('short_name', 'like', '%' . $name . '%');
            })
            ->cursorPaginate(30);
    }
}
