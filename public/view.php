<?php
    require "layout/header.php";    
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<div class="container"><br>
    <div class="row">
        <h4 class="mb-3">All Policies</h4><br><br>
        <table id="view" class="sortable">
            <thead>
            <tr>
                <th>Date created</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Birthdate</th>
                <th>Passport ID</th>
                <th>Email</th>
                <th>Date from</th>
                <th>Date to</th>
                <th>Total days</th>
                <th>Policy type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php $modal = ''; foreach($policy->readPolicy() as $row) {
                    $date_created = new DateTime($row['date_created']);
                    echo "<td>{$date_created->format('d.m.Y.')}</td>";

                    echo "<td>{$row['first_name']}</td>";
                    echo "<td>{$row['last_name']}</td>";

                    $birthdate = new DateTime($row['birthdate']);
                    echo "<td>{$birthdate->format('d.m.Y.')}</td>";

                    echo "<td>{$row['passport_id']}</td>";
                    echo "<td>{$row['email']}</td>";

                    $date_from = new DateTime($row['date_from']);
                    echo "<td>{$date_from->format('d.m.Y.')}</td>";

                    $date_to = new DateTime($row['date_to']);
                    echo "<td>{$date_to->format('d.m.Y.')}</td>";

                    $total_days = strtotime($row['date_from']) - strtotime($row['date_to']);
                    $total_days = abs(floor($total_days/3600/24));
                    echo "<td>{$total_days}</td>";
                    
                    $id = (int)$row['id'];
                    echo "<td>{$row['policy_type']}</td>";
                    echo ($row['policy_type'] == 'group') ? "<td><button class='btn btn-sub' data-toggle='modal' data-target='#modal-$id'>View</button></td>" : "<td></td>";
                    echo "</tr>";

                    if ($row['policy_type'] == 'group') {
                        $query = "SELECT first_name, last_name, birthdate, passport_id FROM additional_insured WHERE policy_owner_id='$id'";
                        $stmt = $policy->conn->prepare($query);
                        if($stmt->execute()) {
                            $additionalView = $stmt->fetchAll(PDO::FETCH_NUM);

                            $modal .= '
                            <div class="modal fade" id="modal-'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Additional insured of '.$row['first_name'].' '.$row['last_name'].'</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">';

                            // TABLE TOP
                            $modal .= '<table class="additionalView sortable">
                            <thead>
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Birthdate</th>
                                <th>Passport ID</th>
                            </tr>
                            </thead>
                            <tbody>';

                            // TABLE MID
                            for ($i = 0; $i < sizeof($additionalView); $i++) {

                                $first_name = $additionalView[$i][0];
                                $last_name = $additionalView[$i][1];
                                $birthdate = $additionalView[$i][2];
                                $birthdate = Datetime::createFromFormat('Y-m-d', $birthdate)->format('d.m.Y.');
                                $passport_id = $additionalView[$i][3];

                                $modal .= "<tr>";
                                $modal .= "<td>".$first_name."</td>";
                                $modal .= "<td>".$last_name."</td>";
                                $modal .= "<td>".$birthdate."</td>";
                                $modal .= "<td>".$passport_id."</td>";
                                $modal .= "</tr>";
                            }

                            // TABLE BOTTOM
                            $modal .= '</tbody></table>';
                                    
                            $modal .= '
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>';

                        } else {
                            echo "No data to display.";
                        }
                    }
                } ?>
            </tbody>
        </table>
    </div>
<div class="modals">
    <?= $modal ?>
</div>

<?php
    require "layout/footer.php";
?>
