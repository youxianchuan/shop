<h1 class="">权限管理</h1>


<table class="table">
    <tr>
        <th>角色名</th>
        <th>角色描述</th>
        <th>权限</th>
        <th>操作</th>
    </tr>
    <?php foreach ($roles as $role):?>
        <tr>
            <td><?=$role->name?></td>
            <td><?=$role->description?></td>
            <td><?php

                $auth=Yii::$app->authManager;
                foreach ($auth->getPermissionsByRole($role->name) as $permission){
                    echo $permission->description."||";
                }

                ?></td>

            <td><a href=""></a><a href="edit?name=<?=$role->name?>" class="btn btn-primary">编辑</a><a href="del?name=<?=$role->name?>" class="btn btn-danger">删除</a></td>

        </tr>
    <?php endforeach;?>
</table>

