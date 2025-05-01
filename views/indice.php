<?php require_once __DIR__ . '/../views/encabezado.php'; ?>
<h2>TAREAS</h2>
<?php if (!empty($errors)): ?>
    <ul class="error">
        <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="POST" action="index.php?action=create">
    <input type="text" name="title" placeholder="Titulo" required>
    <textarea name="description" placeholder="Descripcion"></textarea>
    <input type="date" name="due_date" required>
    <button type="submit">NUEVA TAREA</button>
</form>
<table>
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Fecha de Vencimiento</th>
            <th>Completado</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?php echo htmlspecialchars($task['title']); ?></td>
                <td><?php echo htmlspecialchars($task['description']); ?></td>
                <td><?php echo htmlspecialchars($task['due_date']); ?></td>
                <td>
                    <form method="POST" action="index.php?action=updateStatus">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <input type="checkbox" name="completed" <?php echo $task['completed'] ? 'checked' : ''; ?> onchange="this.form.submit()">
                    </form>
                </td>
                <td>
                    <form method="POST" action="index.php?action=delete">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/../views/pie_de_pagina.php'; ?>