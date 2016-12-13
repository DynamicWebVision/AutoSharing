@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div id="vue-app">

                        <tasks></tasks>
                        <div>
                            @{{ dog }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<template id="task-template">
    <h1 style="color: red;">Tasks (@{{remaining}})</h1>
    <ul>
        <li :class="{'completed': task.completed }" v-for="task in list">
            @{{ task.body }}
            <strong @click='removeTask(task)'>X</strong>
        </li>
    </ul>
</template>
<script>

</script>
@endsection
