<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initialscale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
crossorigin="anonymous">
<title>Issues</title>
</head>
<body>

<h1 style="margin: 50px 50px">Cập nhật thông tin báo cáo vấn đề</h1>

<form action="<?php echo e(route('issues.update', $issue->id)); ?>" method="POST" style="margin: 50px 50px">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="form-group">
        <label for="computer_id">Máy tính</label>
        <select name="computer_id" class="form-control" required>
            <?php $__currentLoopData = $computers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $computer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($computer->id); ?>" <?php echo e($computer->id == $issue->computer_id ? 'selected' : ''); ?>><?php echo e($computer->computer_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="reported_by">Người báo cáo</label>
        <input type="text" name="reported_by" class="form-control" value="<?php echo e($issue->reported_by); ?>" required>
    </div>
    <div class="form-group">
        <label for="reported_date">Ngày báo cáo</label>
        <input type="date" name="reported_date" class="form-control" value="<?php echo e($issue->reported_date); ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả vấn đề</label>
        <textarea name="description" class="form-control" rows="3" required><?php echo e($issue->description); ?></textarea>
    </div>
    <div class="form-group">
        <label for="urgency">Mức độ ưu tiên</label>
        <select name="urgency" class="form-control" required>
            <option value="Low" <?php echo e($issue->urgency == 'Low' ? 'selected' : ''); ?>>Low</option>
            <option value="Medium" <?php echo e($issue->urgency == 'Medium' ? 'selected' : ''); ?>>Medium</option>
            <option value="High" <?php echo e($issue->urgency == 'High' ? 'selected' : ''); ?>>High</option>
        </select>
    </div>
    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" class="form-control" required>
            <option value="Open" <?php echo e($issue->status == 'Open' ? 'selected' : ''); ?>>Open</option>
            <option value="In Progress" <?php echo e($issue->status == 'In Progress' ? 'selected' : ''); ?>>In Progress</option>
            <option value="Resolved" <?php echo e($issue->status == 'Resolved' ? 'selected' : ''); ?>>Resolved</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

</body>
</html><?php /**PATH C:\xampp\htdocs\BTTH4\resources\views/issues/edit.blade.php ENDPATH**/ ?>