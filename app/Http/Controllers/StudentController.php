<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    public function store(Request $request)
    {
        // save file path and images
        $file = $request->file('avatar');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/avatar', $fileName);
        // get data
        $stuData = [
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'avatar' => $fileName,
        ];
        // save
        Student::create($stuData);
        return response()->json(
            ['status' => 200,]
        );
    }
    public function fetchAll(Request $request)
    {
        $students = Student::all();
        $response = '';
        if ($students->count() > 0) {
            $response .= '<table id="stuTable" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach ($students as $student) {
                $response .= '<tr>
                                    <td>' . $student->id . '</td>
                                    <td><img src="storage/avatar/' . $student->avatar . '" alt="" width="50px" height="50px" class="img-thumbnail rounded-circle"></td>
                                    <td>' . $student->first_name . ' ' . $student->last_name . '</td>
                                    <td>' . $student->email . '</td>
                                    <td><a class="userEditBtn" href="#" id="' . $student->id . '" data-bs-toggle="modal"
                            data-bs-target="#editStudentModal"><i class="bi bi-pencil-square green"></i></a> | <a class="userDeleteBtn" href="#" id="' . $student->id . '"><i class="bi bi-trash-fill red"></i></a> </td>
                                </tr>';
            }

            $response .=                '</tbody>
                        </table>';
            echo $response;
        } else {
            echo '<h5 align="center">No Record in the Database</h5>';
        }

        // return response()->json(
        //     ['status' => $student,]
        // );
    }
    public function edit(Request $request){
        $userId = $request->id;
        $student = Student::find($userId);
        return response()->json($student);
    }
    public function update(Request $request)
    {
        $fileName = '';
        $student = Student::find($request->user_id);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatar', $fileName);
            if($student->avatar){
                Storage::delete('public/avatar/'.$student->avatar);
            }
        } else {
            $fileName = $student->avatar;
        }
        // get data
        $stuData = [
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'avatar' => $fileName,
        ];
        // save
        $student->update($stuData);
        return response()->json(
            ['status' => 200,]
        );
    }
    public function delete(Request $request)
    {
        $userId = $request->id;
        $student = Student::find($request->user_id);
        $student->delete();
        
    }
}
