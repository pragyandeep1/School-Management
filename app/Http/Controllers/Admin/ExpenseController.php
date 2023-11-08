<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Student;

class ExpenseController extends Controller
{
   public function expenseCat(){
        return view('admin/expense/expense_cat');
   }

   public function save(Request $request){
       return redirect()->back()->with('success', 'Expense category created Successful'); 
       //dd($request);
   }

   public function expenseManager(){
     // Retrieve the list of expense categories
    $expenseCategories = Expense::all(); // Assuming you have an ExpenseCategory model

    // Retrieve the list of expenses
    $expenses = Expense::all(); // Assuming you have an Expense model

    return view('admin/expense/expense_manager', compact('expenseCategories', 'expenses'));
        // return view('admin/expense/expense_manager');
   }

   public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'expense_category' => 'required',  // Assuming this is the expense category ID
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        // Create and save the expense
        $expense = new Expense;
        $expense->expense_category_id = $request->input('expense_category');
        $expense->amount = $request->input('amount');
        $expense->description = $request->input('description');
        $expense->save();

        return redirect()->route('expense-manager')->with('success', 'Expense created successfully');
    }


}
