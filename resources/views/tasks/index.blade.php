@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ url('task') }}" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Task</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">Add task</button>
                    </div>
                </div>
                {{csrf_field()}}
            </form>
        </div>
    </div>

    @if($tasks->count())
        <div class="panel panel-default">
            <div class="panel-heading">
                Current tasks
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <th>To do:</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            @if($task->done === 0)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td class="col-md-1">
                                        <form action="{{ url('task/' . $task->id) }}" method="post">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form>
                                        <br>
                                        <form action="{{ url('task/' . $task->id) }}" method="post">
                                            <button type="submit" class="btn btn-success">Done</button>
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Done tasks
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <th>Done:</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        @if($task->done === 1)
                            <tr>
                                <td>{{ $task->name }}</td>
                                <td class="col-md-1">
                                    <form action="{{ url('task/' . $task->id) }}" method="post">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                    </form>
                                    <br>
                                    <form action="{{ url('task/undo/' . $task->id) }}" method="post">
                                        <button type="submit" class="btn btn-primary">Not Done</button>
                                        {{ method_field('PATCH') }}
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection