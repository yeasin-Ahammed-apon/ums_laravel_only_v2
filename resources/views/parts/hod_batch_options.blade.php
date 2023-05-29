<div class="mt-1 mb-1 card p-2">
    <div>
        <a href="{{ route('hod.batch.create', $department_id) }}" class="btn btn-sm mt-1 mb-1 btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>
            create
        </a>
        <a href="{{ route('hod.batch.active.list', $department_id) }}" class="btn btn-sm mt-1 mb-1 btn-success">
            <i class="fas fa-circle    "></i>
            Active
        </a>
        <a href="{{ route('hod.batch.admission.list', $department_id) }}" class="btn btn-sm mt-1 mb-1 btn-info">
            <i class="fas fa-lightbulb    "></i>
            Admission on
        </a>
        <a href="{{ route('hod.batch.completed.list', $department_id) }}" class="btn btn-sm mt-1 mb-1 btn-secondary">
            <i class="fas fa-check-circle    "></i>
            Completed
        </a>
    </div>
</div>
