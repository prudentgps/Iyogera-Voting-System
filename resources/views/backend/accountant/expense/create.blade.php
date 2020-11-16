<form method="POST" class="d-block ajaxForm" action="{{ route('expense.store') }}">
    @csrf

    <div class="form-group col-md-12">
        <label for="date">{{ translate('date') }}</label>
        <input type="text" class="form-control date" id="date" data-toggle="date-picker" data-single-date-picker="true" name = "date" value="" required>
        <small id="date_help" class="form-text text-muted">{{ translate('select_a_date') }}.</small>
    </div>

    <div class="form-group col-md-12">
        <label for="amount">{{ translate('amount') }}</label>
        <input type="text" class="form-control" id="amount" name = "amount" required>
        <small id="amount_help" class="form-text text-muted">{{ translate('provide_an_amount') }}.</small>
    </div>

    <div class="form-group col-md-12">
        <label for="expense_category_id">{{ translate('expense_category') }}</label>
        <select class="form-control" name="expense_category_id" id="expense_category_id" required>
            <option value="">{{ translate('select_an_expense_category') }}</option>
            @foreach (App\ExpenseCategory::where(['school_id' => school_id(), 'session' => get_schools()])->get() as $expense_category)
                <option value="{{ $expense_category->id }}">{{ $expense_category->name }}</option>
            @endforeach
        </select>
        <small id="expense_category_id_help" class="form-text text-muted">{{ translate('select_an_expense_category') }}.</small>
    </div>

    <div class="form-group  col-md-12">
        <button class="btn btn-block btn-primary" type="submit">{{ translate('create_expense') }}</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#date').daterangepicker();
    });

    $(".ajaxForm").validate({}); // Jquery form validation initialization
    $(".ajaxForm").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, showAllExpenses);
    });
</script>
