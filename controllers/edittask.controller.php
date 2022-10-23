<?php

if (empty($id) || !is_numeric($id)) {
    http_response_code(400);
    $title = "Bad Request";
    require("views/error400.view.php");
    exit;
}


if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) {
        require("models/employee.model.php");
        require("models/users.model.php");
        require("models/task.model.php");
        require("models/project.model.php");
        $taskModel = new Task();
        $task = $taskModel->getTask($id);
        $taskEmployees = $taskModel->getEmployeeAssignedToTask($id);
        $taskEmployeesIds = array();
        foreach ($taskEmployees as $employee) {
            $taskEmployeesIds[] = $employee["user_id"];
        }
        

        $projectsModel = new Project();
        $projects = $projectsModel->getProjects();
        $employeesModel = new Employee();
        $employees = $employeesModel->getEmployees();
        
        $taskLabels = $taskModel->getLabels();
        $taskCategories = $taskModel->getCategoriesTask();
        
        if (empty($task)) {
            http_response_code(404);
            $title = "Not found";
            require("views/error404.view.php");
            exit;
        }

        if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
            $project_id = $_GET['project_id'];
            $employees = $employeesModel->getMembersOfProject($project_id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($employees);
        } elseif (isset($_GET['noproject'])) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($employees);
        } elseif (isset($_GET['taskCategory']) && $_GET['taskCategory'] == 'delete') {
            if (isset($_POST['catId']) && !empty($_POST['catId'])) {
                $category_id = $_POST['catId'];
                $category = $taskModel->deleteCategoryTask($category_id);
                if ($category) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'success', 'catId' => $category]);
                }
            }
        } elseif (isset($_GET['taskCategory']) && $_GET['taskCategory'] == 'add') {
            if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
                $category_name = $_POST['category_name'];
                $category = $taskModel->newCategoryTask($category_name);
                if ($category) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'success', 'catId' => $category, 'catName' => $category_name ]);
                }
            }
        } elseif (isset($_GET['taskCategory']) && $_GET['taskCategory'] == 'edit') {
            if (isset($_POST['category_name']) && !empty($_POST['category_name']) && isset($_POST['id']) && !empty($_POST['id'])) {
                $category = $taskModel->editCategoryTask($_POST['id'], $_POST['category_name']);
                if ($category) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'success', 'data' => $_POST['category_name']]);
                }
            }
        } elseif (isset($_GET['submit'])) {
            if (isset($_POST['heading']) && !empty($_POST['heading']) &&
                isset($_POST['description']) && !empty($_POST['description']) &&
                isset($_POST['task_id']) && !empty($_POST['task_id']) &&
                isset($_POST['start_date']) && !empty($_POST['start_date']) &&
                isset($_POST['due_date']) && !empty($_POST['due_date']) &&
                isset($_POST['task_status']) && !empty($_POST['task_status']) &&
                isset($_POST['priority']) && !empty($_POST['priority']) &&
                isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                $task_cat_id = $_POST['task_id'];
                $heading = $_POST['heading'];
                $description = $_POST['description'];
                $start_date = $_POST['start_date'];
                $due_date = $_POST['due_date'];
                $task_status = $_POST['task_status'];
                $priority = $_POST['priority'];
                $project_id = $_POST['project_id'] ? $_POST['project_id'] : null;
                if ($priority == 1) {
                    $priority = 'Low';
                } elseif ($priority == 2) {
                    $priority = 'Medium';
                } elseif ($priority == 3) {
                    $priority = 'High';
                }
                $added_by = $_SESSION['user_id'];
                $users_assigned = $_POST['user_id'];

                $task = $taskModel->editTask($id, $heading, $description, $due_date, $start_date, $project_id, $priority, $task_status, $added_by, $users_assigned, $task_cat_id);
                if ($task) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['status' => 'success', 'task_id' => $id, 'message' => 'Task edit successfully']);
                }
            } else {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['status' => 'error']);
            }
        } else {
            $title = "Edit Task";
            require("views/edittask.view.php");
        }
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}
