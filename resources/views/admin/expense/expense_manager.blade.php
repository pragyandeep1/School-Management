@extends('layouts.layout')
@section('title', 'Expense Manager')
@section('content')
    <h1>Expense Manager</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Add New Expense</h2>
            <form method="POST" action="{{ route('expense-manager') }}">
                @csrf

                <div class="form-group">
                    <label for="expense_category">Expense Category</label>
                    <select name="expense_category" id="expense_category" class="form-control">
                            <option value="1">Hello</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="col-md-6">
            <h2>Expense List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenseCategories as $expense)
                        <tr>
                            <td>{{ $expense->category->name }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
