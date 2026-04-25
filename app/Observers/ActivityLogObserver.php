<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class ActivityLogObserver
{
    public function created(Model $model): void
    {
        ActivityLog::create($this->buildPayload($model, 'Created'));
    }

    public function updated(Model $model): void
    {
        ActivityLog::create($this->buildPayload($model, 'Updated'));
    }

    public function deleted(Model $model): void
    {
        ActivityLog::create($this->buildPayload($model, 'Deleted'));
    }

    protected function buildPayload(Model $model, string $action): array
    {
        $description = match(true) {
            isset($model->report_id) => sprintf('%s report with ID %s', $action, $model->report_id),
            isset($model->no_registrasi) => sprintf('%s permohonan with registration %s', $action, $model->no_registrasi),
            default => sprintf('%s model %s', $action, class_basename($model)),
        };

        return [
            'user_id' => auth()->check() ? auth()->id() : ($model->user_id ?? null),
            'action' => $action,
            'description' => $description,
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
        ];
    }
}
