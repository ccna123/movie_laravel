<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Profit;
use App\Models\Seat;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function index()
    {
        return view("admin/admin", [
            "movie_list" => Movie::all(),
            "profit_data" => $this->adminService->get_profit_data(),
            "total_profit" => Profit::sum('profit'),
            "admin_img" => User::where('email', auth()->user()->email)->first()->img
        ]);
    }

    public function updateMovie(Request $request)
    {

        return $this->adminService->updateMovie($request);
    }

    public function deleteMovie(Request $request)
    {
        return $this->adminService->deleteMovie($request);
    }

    public function addMovie(Request $request)
    {
        return $this->adminService->addMovie($request);
    }

    public function updateInfo(Request $request)
    {

        return $this->adminService->update_admin_info($request);
    }

    public function updateImg(Request $request)
    {

        if ($request->hasFile('profile_img')) {
            $ImgNewName = time() . '.' . $request->profile_img->extension();
            $request->profile_img->move(public_path('images'), $ImgNewName);

            $user = auth()->user();
            $user->img = $ImgNewName;
            $user->save();
            return response()->json([
                'img_name' => $ImgNewName
            ]);
        }
        return response()->json([
            'mess' => 'fail'
        ]);
    }

    public function updateAdminName(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->save();

        return response()->json([
            'mess' => 'success'
        ]);
    }

    public function updateAdminEmail(Request $request)
    {
        $user = auth()->user();
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'mess' => 'success'
        ]);
    }

    public function import_movie_data(Request $request)
    {
        if ($request->hasFile('file')) { // Check for the file

            $file = $request->file("file");
            $fileContent = file($file->getPathname());

            $isFirstRow = true;

            foreach ($fileContent as $line) {

                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue;
                }

                $data = str_getcsv($line, ";");
                Movie::create([
                    'id' => $data[0],
                    'imdb_id' => $data[1],
                    'name' => $data[2],
                    'ticket_fee' => $data[3],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            return redirect()->back()->with("Imported successfully");
        }
        return response()->json(['mess' => 'No file found']); // Response if no file is present
    }
    public function import_seat_data(Request $request)
    {
        if ($request->hasFile('file')) { // Check for the file

            $file = $request->file("file");
            $fileContent = file($file->getPathname());

            $isFirstRow = true;

            foreach ($fileContent as $line) {

                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue;
                }

                $data = str_getcsv($line, ";");
                Seat::create([
                    'id' => $data[0],
                    'seat_code' => $data[1],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            return redirect()->back()->with("Imported successfully");
        }
        return response()->json(['mess' => 'No file found']); // Response if no file is present
    }
}
