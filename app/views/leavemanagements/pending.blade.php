@extends('layouts.default')
@section('body')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2>Leaves Management</h2>
        <?php if ($leaves && count($leaves)) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leaves as $leave) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $leave['id'] ?></th>
                            <th scope="row"><?php echo $leave['id'] ?></th>
                            <td>{{ date("d F Y",strtotime($leave->start)) }}</td>
                            <td>{{ date("d F Y",strtotime($leave->end)) }}</td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo  route('leave_approve', array('leave'=>$leave->id)); ?>">Approve</a>
                                <a class="btn btn-warning" href="<?php echo  route('leave_reject', array('leave'=>$leave->id)); ?>">Reject</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            No Pending Queue
        <?php } ?>
    </div>
</div>
@stop