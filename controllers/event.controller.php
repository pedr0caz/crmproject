<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . ROOT . "/login");
    exit;
} else {
    if (isset($_SESSION["user_role"])) {
        require_once("models/events.model.php");
        require_once("models/project.model.php");
        require_once("models/users.model.php");
        $eventsModel = new Events();
        $projectsModel = new Project();
        $usersModel = new User();
        $eventsCalendar = array();
        if ($_SESSION["user_role"] == "1") {
            $projects = $eventsModel->getProjects();
            $tasks = $eventsModel->getTasks();
            $users = $usersModel->getBirthdays();
        } elseif ($_SESSION["user_role"] == "2") {
            $projects = $eventsModel->getProjectsOfEmployee($_SESSION["user_id"]);
            $tasks = $eventsModel->getTasksOfEmployee($_SESSION["user_id"]);
            $users = $usersModel->getBirthdays();
        } elseif ($_SESSION["user_role"] == "3") {
            $projects = $eventsModel->getProjectByClientID($_SESSION["user_id"]);
        }

        foreach ($projects as $key => $project) {
            $eventsCalendar[] = array(
                "id" => $project["project_id"],
                "type" => "Project",
                "title" => "📝 ".$project["project_name"],
                "start" => $project["start_date"],
                "end" => $project["deadline"],
                "backgroundColor" => "#3366ff",
                "borderColor" => "#3366ff",
                "textColor" => "#fff",

            );
        }
        foreach ($tasks as $key => $task) {
            $eventsCalendar[] = array(
                "id" => $task["task_id"],
                "type" => "Task",
                "title" => "✍️ ".$task["heading"],
                "start" => $task["start_date"],
                "end" => $task["due_date"],
                "backgroundColor" => "#FF6600",
                "borderColor" => "#FF6600",
                "textColor" => "#fff",

            );
        }
        if (isset($users)) {
            foreach ($users as $key => $user) {
                $eventsCalendar[] = array(
                    "id" => $user["id"],
                    "type" => "Birthday",
                    "title" => "🎂 ".$user["name"],
                    "start" => $user["date_of_birth"],
                    "backgroundColor" => "#FF0000",
                    "borderColor" => "#FF0000",
                    "textColor" => "#fff",

                );
            }
        }
       
        $title = "Events";
        require("views/event/event.view.php");
    } else {
        header("Location: " . ROOT . "");
        exit;
    }
}
