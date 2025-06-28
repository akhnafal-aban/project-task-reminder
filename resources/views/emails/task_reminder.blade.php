@php use Illuminate\Support\Carbon; @endphp
<p>Hi {{ $user->name }},</p>
<p>This is your daily reminder. You have the following unfinished tasks:</p>
<ul>
    @foreach($tasks as $task)
        <li>
            <strong>{{ $task->title }}</strong>
            @if($task->due_date)
                (Due: {{ \Illuminate\Support\Carbon::parse($task->due_date)->format('Y-m-d') }})
            @endif
            - Status: {{ $task->status->label() }}
        </li>
    @endforeach
</ul>
<p>Please make sure to complete your tasks on time!</p>
<p>Best regards,<br>Your Project Management System</p>
