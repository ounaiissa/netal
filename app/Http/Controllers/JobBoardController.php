<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffering;
use App\Models\User;
use App\Models\InterestedUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class JobBoardController extends Controller
{

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'job_title' => 'required',
            'description' => 'required',
            'budget' => 'required',
            'due_date' => 'required',
            // 'looking_for' => 'required',
        ]);

        $company = User::where('userType', 'company')->findOrFail(auth()->user()->id);

        $jobOffering = JobOffering::create([
            'company_id' => $company->id,
            'job_title' => $validatedData['job_title'],
            'description' => $validatedData['description'],
            'budget' => $validatedData['budget'],
            'due_date' => $validatedData['due_date'],
        ]);


        // If you have the interested users' IDs in an array, you can use sync() instead of attach()
        // $jobOffering->interestedUsers()->attach([1, 2, 3]);

        dd($jobOffering);

        // return redirect()->route('project.show', $jobOffering->id);
        return response()->json('job board created successfully.');
    }


    public function getData()
    {
        $id = JobOffering::select('id')->get();
        $company_id = JobOffering::select('company_id')->get();
        $job_title = JobOffering::select('job_title')->get();
        $description = JobOffering::select('description')->get();
        $budget = JobOffering::select('budget')->get();
        $due_date = JobOffering::select('due_date')->get();
        $jobOfferings = JobOffering::with('interestedUsers.user')->get();

        $data = [
            'id' => $id,
            'job_title' => $job_title,
            'description' => $description,
            'company_id' => $company_id,
            'budget' => $budget,
            'due_date' => $due_date,
            'jobOfferings' => $jobOfferings,
        ];

        return response()->json($data);
    }


    public function update(Request $request, $id)
    {
        // Validate the request data for the fields that you are updating
        $validatedData = $request->validate([
            'jobTitle' => 'required',
            'description' => 'required',
            'budget' => 'required',
            'dueDate' => 'required|date',
        ]);

        try {
            $jobboard = JobOffering::findOrFail($id);

            // Update the job board attributes
            $jobboard->job_title = $validatedData['jobTitle'];
            $jobboard->description = $validatedData['description'];
            $jobboard->budget = $validatedData['budget'];
            $jobboard->due_date = $validatedData['dueDate'];

            // Save the updated job board
            $jobboard->save();

            // Return a success response
            return response()->json(['message' => 'Job board updated successfully']);
        } catch (\Exception $e) {
            // Return an error response if any exception occurs
            return response()->json(['error' => 'Failed to update job board'], 500);
        }
    }

    // interested users

    public function storeInterestedUser(Request $request)
    {
        $validatedData = $request->validate([
            'jobboardId' => 'required|exists:job_offerings,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $jobboardId = $validatedData['jobboardId'];

        try {
            // Check if the job offering with the provided ID exists
            $jobOffering = JobOffering::findOrFail($jobboardId);

            // Create a new InterestedUser instance
            $interestedUser = new InterestedUser();
            $interestedUser->job_offering_id = $jobOffering->id; // Use the job offering's ID
            $interestedUser->user_id = $validatedData['user_id']; // Set the user_id from the request data
            $interestedUser->save();


            return response()->json(['message' => 'Interested user saved successfully']);
        } catch (ModelNotFoundException $e) {
            // Handle the case when the job offering with the provided ID is not found
            return response()->json(['error' => 'Job offering not found'], 404);
        } catch (\Exception $e) {
            // Handle any other exceptions that might occur during the process
            return response()->json(['error' => 'Failed to save interested user'], 500);
        }
    }


    public function getInterestedUsers($jobboardId)
    {
        try {
            $jobOffering = JobOffering::findOrFail($jobboardId);
            $interestedUsers = $jobOffering->interestedUsers;

            // Return the interested users as a response
            return response()->json($interestedUsers);
        } catch (ModelNotFoundException $e) {
            // Handle the case when the job offering with the provided ID is not found
            return response()->json(['error' => 'Job offering not found'], 404);
        } catch (\Exception $e) {
            // Handle any other exceptions that might occur during the process
            return response()->json(['error' => 'Failed to fetch interested users'], 500);
        }
    }
}
