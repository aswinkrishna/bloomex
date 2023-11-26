<?php

namespace App\Repositories;

use App\Models\IssueModel;

class IssueRepository
{
    protected $model;

    /**
     * Constructor for the class.
     *
     * @param IssueModel $model The IssueModel object.
     */
    public function __construct(IssueModel $model)
    {
        $this->model = $model;
    }

    /**
     * Creates an issue using the given data.
     *
     * @param array $data The data used to create the issue.
     * @return IssueModel The created issue model.
     */
    public function createIssue(array $data): IssueModel
    {
        return $this->model->create($data);
    }

    /**
     * Returns the list of models.
     *
     * @return mixed The list of models.
     */
    public function list()
    {
        return $this->model;
    }

    /**
     * Retrieves a record from the model by its ID.
     *
     * @param int $id The ID of the record.
     * @return \Illuminate\Database\Eloquent\Model The retrieved record.
     */
    public function getById(int $id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * Updates an issue with new data.
     *
     * @param IssueModel $issue The issue to be updated.
     * @param array $data An array containing the new data for the issue.
     * @return mixed The result of the update operation.
     */
    public function updateIssue(IssueModel $issue, array $data)
    {
        return $issue->update($data);
    }
}