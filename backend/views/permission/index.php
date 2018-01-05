<h1 class="">权限管理</h1>


<table class="table">
    <tr>
        <th>权限名</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($premissions as $premission):?>
        <tr>
            <td><?=strpos($premission->name,'/')?"---":""?><?=$premission->name?></td>
            <td><?=$premission->description?></td>

            <td><a href=""></a><a href="edit?name=<?=$premission->name?>" class="btn btn-primary">编辑</a><a href="del?name=<?=$premission->name?>" class="btn btn-danger">删除</a></td>

        </tr>
    <?php endforeach;?>
</table>

