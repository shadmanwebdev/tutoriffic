<?php


if(isset($_POST['del'])) {
    // var_dump($_POST);
    $service = new Service();
    $service->delete_service($_POST['del_id']);
}

function services_admin() {
    $services = $this->get_services();

    $servicesStr = "";
    foreach ($services as $service) {
        $servicesStr .= "<tr class='clickable-row' data-href='./edit-service?id={$service['id']}' style='cursor:pointer;'>
            <td>{$service['name']}</td>
            <td class='table-action'>
                <a href='./edit-service?id={$service['id']}'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 align-middle'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg></a>
                <span onclick='get_popup_content(\"{$service['id']}\")'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash align-middle'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg></span>
            </td>
        </tr>";
    }

    echo $servicesStr;

}

function delete_service($id) {

    $sql = "DELETE FROM services WHERE id = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->bind_param("i", $id);
    if($stmt->execute()) {
        $status = '1';
    } else {
        $status = '0';
    }
    echo $status;


}

?>