<tr>
    <td>
        <select id="week" class="form-select" name="week">
            <option selected>Choose...</option>
            <option id="Mon">Mon</option>
            <option id="Tue">Tue</option>
            <option id="Wed">Wed</option>
            <option id="Thur">Thur</option>
            <option id="Fri">Fri</option>
            <option id="Sat">Sat</option>
        </select>
    </td>
    <tr>
        <td>
            <select id="9-10" class="form-select" name="9-10">
                <option selected>Choose...</option>
                <option>Free</option>
                <?php
            $sqltt = 'SELECT * FROM `bcasub` WHERE `sem`="$sem"';
            $restt = mysqli_query($conn, $sqltt);
            while ($rowtt = mysqli_fetch_assoc($restt)) {
                echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
            }
            ?>
        </select>
    </tr>
    </td>
    <td>
        <select id="10-11" class="form-select" name="10-11">
            <option selected>Choose...</option>
            <option>Free</option>
            <?php
            $sqltt = 'SELECT * FROM `bcasub` WHERE `sem`="$sem"';
            $restt = mysqli_query($conn, $sqltt);
            while ($rowtt = mysqli_fetch_assoc($restt)) {
                echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
            }
            ?>
        </select>
    </td>
    <td>
        <select id="11-12" class="form-select" name="11-12">
            <option selected>Choose...</option>
            <option>Free</option>
            <?php
            $sqltt = 'SELECT * FROM `bcasub` WHERE `sem`="$sem"';
            $restt = mysqli_query($conn, $sqltt);
            while ($rowtt = mysqli_fetch_assoc($restt)) {
                echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
            }
            ?>
        </select>
    </td>
    <td>
        <select id="12-13" class="form-select" name="12-13">
            <option selected>Choose...</option>
            <option>Free</option>
            <?php
            $sqltt = 'SELECT * FROM `bcasub` WHERE `sem`="$sem"';
            $restt = mysqli_query($conn, $sqltt);
            while ($rowtt = mysqli_fetch_assoc($restt)) {
                echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
            }
            ?>
        </select>
    </td>
    <td>
        <select id="13-14" class="form-select" name="13-14">
            <option selected>Choose...</option>
            <option>Lunch</option>
        </select>
    </td>
    <td>
        <select id="14-15" class="form-select" name="14-15">
            <option selected>Choose...</option>
            <option>Free</option>
            <?php
            $sqltt = 'SELECT * FROM `bcasub` WHERE `sem`="$sem"';
            $restt = mysqli_query($conn, $sqltt);
            while ($rowtt = mysqli_fetch_assoc($restt)) {
                echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
            }
            ?>
        </select>
    </td>
    <td>
        <select id="15-16" class="form-select" name="15-16">
            <option selected>Choose...</option>
            <option>Free</option>
            <?php
            $sqltt = 'SELECT * FROM `bcasub` WHERE `sem`="$sem"';
            $restt = mysqli_query($conn, $sqltt);
            while ($rowtt = mysqli_fetch_assoc($restt)) {
                echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
            }
            ?>
        </select>
    </td>
    <td>
        <select id="16-17" class="form-select" name="16-17">
            <option selected>Choose...</option>
            <option>Free</option>
            <?php
            $sqltt = 'SELECT * FROM `bcasub` WHERE `sem`="$sem"';
            $restt = mysqli_query($conn, $sqltt);
            while ($rowtt = mysqli_fetch_assoc($restt)) {
                echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
            }
            ?>
        </select>
    </td>
</tr>