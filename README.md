# tree-structure

## 1. Get all groups data to generate structure from DB
```
$treeData = array();

function getGroupData($con) {
    // Get group array
    $groupQuery = "select id, name, parent_id, pos, level from groups";
    $groupRecords = mysqli_query($con, $groupQuery);
    $groups = array();

    while ($groupRow = mysqli_fetch_assoc($groupRecords)) {
        $groups[] = array(
            "id"=>$groupRow['id'],
            "name"=>$groupRow['name'],
            "parent_id"=>$groupRow['parent_id'],
            "pos"=>$groupRow['pos'],
            "level"=>$groupRow['level']
        );
    };
    return $groups;
}

$groupData = getGroupData($link);
```
## 2. Generate structure
```
$groupsById = array();
for($i = 0, $c = count($groupData); $i < $c; $i++) {
    $group = &$groupData[$i];
    $group['children'] = array();
    $group['icon'] = "fa fa-folder icon-lg leap";
    $group['text'] = $group['name'];
    $groupsById[$group["id"]] = &$group;

}
$treeData = array();
for($i = 0, $c = count($groupData); $i < $c; $i++) {
    $group = &$groupData[$i];
    $parent_id = $group["parent_id"];
    if (!isset($groupsById[$parent_id])) {
        $treeData[] = &$group;
    } else {
        $parent = &$groupsById[$parent_id];
        $parent['icon'] = "fa fa-folder icon-lg";
        $parent['children'][] = &$group;
    }
}
```
