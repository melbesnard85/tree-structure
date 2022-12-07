<?php
    // 1. Get all groups data to generate tree structure
    // 2. Generate tree structure:
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
