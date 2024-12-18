<?php

namespace App\Services;

use App\Enums\OperationLogActionType;
use App\Interfaces\IOperationLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class Service
 * @package App\Services
 */
class Service
{
    public const string SCENARIO_CREATE = 'create';
    public const string SCENARIO_UPDATE = 'update';
    public const string SCENARIO_DELETE = 'delete';
    public const string SCENARIO_RESTORE = 'restore';

    /**
     * @return Authenticatable|null|User
     */
    public function getAuthUser(): User|Authenticatable|null
    {
        return Auth::user();
    }

    /**
     * @return IOperationLog
     */
    protected function getOperationLogService(): IOperationLog
    {
        return app(IOperationLog::class);
    }

    /**
     * @param Model $model
     * @param OperationLogActionType $action
     * @param array $metadata
     * @return void
     */
    public function runOperationLog(Model $model, OperationLogActionType $action, array $metadata = []): void
    {
        $operationLog = $this->getOperationLogService()
            ->setAction($action)
            ->setOwner($model)
            ->setCreatedBy(Auth::user());

        if (!empty($metadata)) {
            $operationLog->setMetadata($metadata);
        }

        $operationLog->log();
    }

    /**
     * @return DocumentService
     */
    public function getDocumentService(): DocumentService
    {
        return app(DocumentService::class);
    }

    /**
     * @param bool $isRequired
     * @return array
     */
    public function getDocumentServiceRules(bool $isRequired = false): array
    {
        $documentRules = $this->getDocumentService()
            ->setScenario(DocumentService::SCENARIO_CREATE)
            ->validation([], true);

        $documentRules = collect($documentRules)->mapWithKeys(function ($value, $key) {
            return ["files.*.$key" => $value];
        })->all();
        $documentRules['files'] = [$isRequired ? 'required' : 'nullable', 'array'];

        return $documentRules;
    }
}
