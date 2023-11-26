<?php

namespace App\Http\Controllers;

use App\Services\IssueService;
use Exception;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    protected $issueService;

    /**
     * Constructor for the class.
     *
     * @param IssueService $issueService The issue service.
     */
    public function __construct(IssueService $issueService)
    {
        $this->issueService = $issueService;
    }

    /**
     * Store a new issue.
     *
     * @param Request $request The HTTP request object.
     * @throws Exception When an error occurs while creating the issue.
     * @return JsonResponse The JSON response containing the message.
     */
    public function store(Request $request)
    {
        try {
            $this->issueService->create($request->all());

            return response()->json(['message' => 'Issue created successfully.']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the specified resource.
     *
     * @param int $id The ID of the resource to show.
     * @throws Exception If there is an error retrieving the resource.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the resource.
     */
    public function show($id)
    {
        try {
            $issue = $this->issueService->getById($id);

            return response()->json(['data' => $issue]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Updates an issue.
     *
     * @param Request $request the request object
     * @param int $id the ID of the issue to be updated
     * @throws Exception if an error occurs during the update process
     * @return JsonResponse the JSON response indicating the success or failure of the update
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->issueService->update($id, $request->all());

            return response()->json(['message' => 'Issue updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Destroy the issue with the given ID.
     *
     * @param int $id The ID of the issue to be deleted.
     * @throws Exception If an error occurs during the deletion process.
     * @return JsonResponse The JSON response indicating the success or failure of the deletion.
     */
    public function destroy(int $id)
    {
        try {
            $this->issueService->delete($id);

            return response()->json(['message' => 'Issue deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Retrieves a list of issues.
     *
     * @throws Exception if an error occurs while retrieving the issues.
     * @return array The list of issues.
     */
    public function list()
    {
        try {
            $issues = $this->issueService->list();

            return response()->json($issues);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
