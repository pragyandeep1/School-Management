<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';
	protected $fillable = [
        'name', 'roll_no', 'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /*public function search(Request $req){
        try{
            $att = new Attendance();
            $postData = $req->post();
            $data = $att->student_table($postData);
            echo json_encode($data);
            exit();
        }
        catch(Exception $e){
            
        }
    }*/
}
