<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Hrshadhin\Userstamps\UserstampsTrait;

class GController extends Model
{
    use SoftDeletes;
        const EMPLOYEE_DESIGNATION_TYPES = [
        1 => 'Principal',
        2 => 'Vice Principal',
        3 => 'Professor',
        4 => 'Asst. Professor',
        5 => 'Associate Professor',
        6 => 'Lecturer',
        7 => 'Headmaster',
        8 => 'Asst. Headmaster',
        9 => 'Asst. Teacher',
        10 => 'Demonstrator',
        11 => 'Instructor',
        12 => 'Lab Assistant',
        13 => 'Clerk',
        14 => 'Computer Operator',
        15 => 'Accountant',
        16 => 'Cashier',
        17 => 'Aya',
        18 => 'Peon',
        19 => 'Night guard',
        20 => 'Other'
    ];

    const TEACHER_DESIGNATION_TYPES = [
        1 => 'Principal',
        2 => 'Vice Principal',
        3 => 'Professor',
        4 => 'Asst. Professor',
        5 => 'Associate Professor',
        6 => 'Lecturer',
        7 => 'Headmaster',
        8 => 'Asst. Headmaster',
        9 => 'Asst. Teacher',
        10 => 'Demonstrator',
        11 => 'Instructor'
    ];

    const EMPLOYEE_PRINCIPAL = 1;
    const EMPLOYEE_HEADMASTER = 7;

    const weekDays = [
        0 => "Sunday",
        1 => "Monday",
        2 => "Tuesday",
        3 => "Wednesday",
        4 => "Thursday",
        5 => "Friday",
        6 => "Saturday",
    ];

    const LANGUEAGES = [
        'en' => 'English',
    ];
    const USER_ADMIN = 1;
	const USER_SCHOOL = 2;
	const USER_BRANCH = 3;
    const USER_TEACHER = 4;
    const USER_STUDENT = 5;
    const USER_PARENTS = 6;
    const USER_ACCOUNTANT = 7;
    const USER_LIBRARIAN = 8;
    const USER_RECEPTIONIST = 9;
    const ACTIVE = '1';
    const INACTIVE = '0';
    const EMP_TEACHER = GController::USER_TEACHER;
    const EMP_SHIFTS = [
        1 => 'Day',
        2 => 'Night'
    ];
    const GENDER = [
        1 => 'Male',
        2 => 'Female'
    ];
    const RELIGION = [
        1 => 'Hindu',
        2 => 'Muslim',
        3 => 'Christian',
        4 => 'Sikh',
        5 => 'Buddhist',
        6 => 'Jain'
    ];

    const BLOOD_GROUP = [
        1 => 'A+',
        2 => 'A-',
        3 => 'B+',
        4 => 'B-',
        5 => 'O+',
        6 => 'O-',
        7 => 'AB+',
        8 => 'AB-',
    ];

    const SUBJECT_TYPE = [
        1 => 'Core',
        2 => 'Electives',
        3 => 'Selective'
    ];

    const ATTENDANCE_TYPE = [
        0 => 'Absent',
        1 => 'Present'
    ];

    const LEAVE_TYPES = [
        1 => 'Casual leave (CL)',
        2 => 'Sick leave (SL)',
        3 => 'Undefined leave (UL)',
        4 => 'Maternity leave (ML)',
        5 => 'Special leave (SL)',
    ];

    const MARKS_DISTRIBUTION_TYPES = [
        1 => "Written",
        2 => "MCQ",
        3 => "SBA",
        4 => "Attendance",
        5 => "Assignment",
        6 => "Lab Report",
        7 => "Practical",
    ];

    const GRADE_TYPES = [
        1 => 'A+',
        2 => 'A',
        3 => 'B+',
        4 => 'B',
        5 => 'C+',
        6 => 'C',
        7 => 'D',
    ];

    const SECTION = [
        1 => 'A',
        2 => 'B',
        3 => 'C',
        4 => 'D',
        5 => 'E',
    ];

    const STATE = [
        1 => 'Andaman and Nicobar',
        2 => 'Andhra Pradesh',
        3 => 'Arunachal Pradesh',
        4 => 'Assam',
        5 => 'Bihar',
        6 => 'Chandigarh',
        7 => 'Chhattisgarh',
        8 => 'Dadra And Nagar Haveli',
        9 => 'Daman And Diu',
        10 => 'Delhi',
        11 => 'Goa',
        12 => 'Gujarat',
        13 => 'Haryana',
        14 => 'Himachal Pradesh',
        15 => 'Jammu and Kashmir',
        16 => 'Jharkhand',
        17 => 'Karnataka',
        18 => 'Kerala',
        19 => 'Ladakh',
        20 => 'Lakshadweep',
        21 => 'Madhya Pradesh',
        22 => 'Maharashtra',
        23 => 'Manipur',
        24 => 'Meghalaya',
        25 => 'Mizoram',
        26 => 'Nagaland',
        27 => 'Odisha',
        28 => 'Puducherry',
        29 => 'Punjab',
        30 => 'Rajasthan',
        31 => 'Sikkim',
        32 => 'Tamil Nadu',
        33 => 'Telangana',
        34 => 'Tripura',
        35 => 'Uttar Pradesh',
        36 => 'Uttarakhand',
        37 => 'West Bengal',
    ];

    const PASSING_RULES = [1 => 'Over All', 2 => 'Individual', 3 => 'Over All & Individual'];


}
