<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    $title = MENU_DASHBOARD;

    require("models/users.model.php");
    require("models/task.model.php");
    require("models/project.model.php");
    require("models/employee.model.php");
    $usersModel = new User();
    $taskModel = new Task();
    $projectModel = new Project();
    $employeeModel = new Employee();
    $department = $usersModel->getDepartment($_SESSION["user_id"]);
    $designation = $usersModel->getDesignation($_SESSION["user_id"]);

    $designationD = !empty($designation["name"]) ? $designation["name"] : "No designation";

 
    $birthdays = $usersModel->getBirthdays();
    $notices = $usersModel->getNotices($_SESSION["user_id"], $_SESSION["user_role"]);
    if ($_SESSION["user_role"] <= 2) {
        $tasks = $taskModel->getTasksNotFinished($_SESSION["user_id"]);
        $projects = $employeeModel->getProjectsOfEmployee($_SESSION["user_id"]);
    } else {
        $tasks = $taskModel->getTasksOfProjects($_SESSION["user_client_id"]);
        $projects = $projectModel->getProjectByClientID($_SESSION["user_client_id"]);
    }

    $overdueTasks = 0;
    $incompleteTasks = 0;
    $overdueProjects = 0;
    $incompleteProjects = 0;
    if (!empty($tasks)) {
        foreach ($tasks as $task) {
            $diff = date_diff(date_create('now'), date_create($task['due_date']));
            if ($task['slug'] == 'incomplete') {
                $incompleteTasks++;
            } elseif ($diff->format('%R%a') < 0) {
                if ($diff->format('%R%a') < 0) {
                    $overdueTasks++;
                }
            }
        }
    }
   
    if (!empty($projects)) {
        foreach ($projects as $project) {
            $diff = date_diff(date_create('now'), date_create($project['deadline']));
            if ($project['status'] == 'incomplete' || $project['status'] == 'in progress') {
                $incompleteProjects++;
            } elseif ($diff->format('%R%a') < 0) {
                if ($diff->format('%R%a') < 0) {
                    $overdueProjects++;
                }
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['flag'])) {
            setcookie('lang', $_POST['flag'], time() + (86400 * 30));
            header("content-type: application/json");
            echo json_encode(array("status" => "success"));
            exit;
        }
    } else {
        function countdays($date)
        {
            $olddate =  substr($date, 4);
            $newdate = date("Y") ."".$olddate;
            $nextyear = date("Y") ."".$olddate;
            if (strtotime($newdate) > strtotime(date("Y-m-d"))) {
                $start_ts = strtotime($newdate);
                $end_ts = strtotime(date("Y-m-d"));
                $diff = $end_ts - $start_ts;
                $n = round($diff / (60*60*24));
                                    
                $return = substr($n, 1);
                return G_IN." ".$return." ".G_DAYS;
            } else {
                $start_ts = strtotime(date("Y-m-d"));
                $end_ts = strtotime($nextyear);
                $diff = $end_ts - $start_ts;
                $n = round($diff / (60*60*24));
                if ($n == 365) {
                    return G_TODAY;
                } else {
                    $return = substr($n, 1);
                    return $return." ".G_DAYS." ".G_AGO;
                }
            }
        }
            

        require("views/dashboard/home.view.php");
    }
}
