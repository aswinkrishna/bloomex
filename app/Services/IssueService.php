<?php

namespace App\Services;

use App\Models\IssueModel;
use App\Repositories\IssueRepository;
use App\Services\Redmine\IssueApiService;

class IssueService
{
    protected $issueRepository;

    /**
     * Constructs a new instance of the class.
     *
     * @param IssueRepository $issueRepository The issue repository to be used.
     */
    public function __construct(IssueRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    /**
     * Retrieves a list of issues from the issue repository and returns it as a DataTables response.
     *
     * @return DataTablesResponse The DataTables response containing the list of issues.
     */
    public function list()
    {
        $issues = $this->issueRepository->list();

        return $issues::when(request('search'), function ($query) {
            $query->where('subject', 'like', '%' . request('search') . '%');
            $query->orWhere('description', 'like', '%' . request('search') . '%');
        }) ->paginate(10);
    }

    /**
     * Creates a new issue with the given data.
     *
     * @param array $data The data for creating the issue.

     * @return Issue The created issue.
     */
    public function create(array $data)
    {
        $insertData = $this->processInsertData($data);
        $issue =  $this->issueRepository->createIssue($insertData);

        if (config('redmine.sync')) {
            IssueApiService::syncIssue($issue);
        }

        return $issue;
    }

    /**
     * Retrieves an issue by its ID.
     *
     * @param int $id The ID of the issue to retrieve.
     * @return mixed The retrieved issue.
     */
    public function getById(int $id)
    {
        return $this->issueRepository->getById($id);
    }

    /**
     * Update an issue with the given ID using the provided data.
     *
     * @param int $id The ID of the issue to update.
     * @param array $data An array of data to update the issue with.
     */
    public function update(int $id, array $data)
    {
        $issue = $this->issueRepository->getById($id);
        $updateData = $this->processInsertData($data);

        return $this->issueRepository->updateIssue($issue, $updateData);
    }

    /**
     * Process the given data for insertion.
     *
     * @param array $data The data to be processed.
     * @return array The processed data.
     */
    public function processInsertData(array $data)
    {
        return [
            'project_id' => $data['project'],
            'subject' => $data['subject'],
            'description' => $data['description'],
            'due_date' => $data['due_date'],
            'status_id' => 0,
            'category_id' => 0,
        ];
    }

    /**
     * Deletes an issue by its ID.
     *
     * @param int $id The ID of the issue to be deleted.
     * @return bool Returns true if the issue was successfully deleted.
     */
    public function delete(int $id)
    {
        $issue = $this->issueRepository->getById($id);
        $issue->delete();

        return true;
    }
}