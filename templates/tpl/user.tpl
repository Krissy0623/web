<{if $op=="op_list"}>
    <table class="table table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr>
                <th scope="col">帳號</th>
                <th scope="col">姓名</th>
                <th scope="col">電話</th>
                <th scope="col">EMAIL</th>
                <th scope="col">狀態</th>
                <th scope="col">功能</th>
            </tr>
        </thead>
        <tbody>
            <{foreach $rows as $row}>  <{* <{foreach $來源 as $別名}> *}>
            <tr>
                <td><{$row.uname}></td> <{* <{$別名.索引}> *}>
                <td><{$row.name}></td>
                <td><{$row.tel}></td>
                <td><{$row.email}></td>
                <td><{$row.kind}></td>
                <td></td>
            </tr>
            <{foreachelse}>
                <tr>
                    <td colspan=6>目前沒有資料</td>
                </tr>
            <{/foreach}>
        </tbody>
    </table>
<{/if}>