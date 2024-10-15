<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อโรงพยาบาลเอกชนในกรุงเทพฯ</title>
    <script>
        async function getDataFromAPI() {
            let response = await fetch('http://202.44.40.193/~aws/JSON/priv_hos.json');
            let rawData = await response.text(); // อ่านผลลัพธ์
            let objectData = JSON.parse(rawData); // แปลผลลัพธ์เป็น object

            // ดึง <tbody> สำหรับตารางของแต่ละกลุ่มขนาดโรงพยาบาล
            let largeHospitalTableBody = document.getElementById('largeHospitalTableBody');
            let mediumHospitalTableBody = document.getElementById('mediumHospitalTableBody');
            let smallHospitalTableBody = document.getElementById('smallHospitalTableBody');

            for (let i = 0; i < objectData.features.length; i++) {
                let hospitalName = objectData.features[i].properties.name;
                let numBeds = objectData.features[i].properties.num_bed;

                // สร้างแถวในตาราง
                let row = document.createElement('tr');

                // สร้างคอลัมน์สำหรับลำดับ, ชื่อโรงพยาบาล และติ๊กประเภทขนาด
                let cellNo = document.createElement('td');
                let cellName = document.createElement('td');
                let cellBeds = document.createElement('td');
                let cellLarge = document.createElement('td');
                let cellMedium = document.createElement('td');
                let cellSmall = document.createElement('td');

                // เพิ่มลำดับที่
                cellNo.innerText = i + 1;

                // เพิ่มชื่อโรงพยาบาล
                cellName.innerText = hospitalName;
                cellBeds.innerText = numBeds;

                // ตรวจสอบขนาดของโรงพยาบาลและแสดงเครื่องหมาย ✓ ในช่องที่ตรงกับขนาดของโรงพยาบาล
                if (numBeds >= 91) {
                    cellLarge.innerHTML = '✓';  // ขนาดใหญ่
                    largeHospitalTableBody.appendChild(row);
                } else if (numBeds >= 31) {
                    cellMedium.innerHTML = '✓';  // ขนาดกลาง
                    mediumHospitalTableBody.appendChild(row);
                } else {
                    cellSmall.innerHTML = '✓';  // ขนาดเล็ก
                    smallHospitalTableBody.appendChild(row);
                }

                // เพิ่มคอลัมน์เข้าในแถว
                row.appendChild(cellNo);
                row.appendChild(cellName);
                row.appendChild(cellBeds);
                row.appendChild(cellLarge);
                row.appendChild(cellMedium);
                row.appendChild(cellSmall);
            }
        }

        getDataFromAPI(); // เรียกฟังก์ชันเพื่อดึงข้อมูล
    </script>
</head>
<body>
    <h1>รายชื่อโรงพยาบาลเอกชนในกรุงเทพฯ</h1>

    <!-- กลุ่มโรงพยาบาลขนาดใหญ่ -->
    <h2>โรงพยาบาลขนาดใหญ่ (91 เตียงขึ้นไป)</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>ชื่อโรงพยาบาล</th>
                <th>จำนวนเตียง</th>
                <th>ขนาดใหญ่</th>
                <th>ขนาดกลาง</th>
                <th>ขนาดเล็ก</th>
            </tr>
        </thead>
        <tbody id="largeHospitalTableBody">
            <!-- ข้อมูลโรงพยาบาลขนาดใหญ่จะถูกเติมเข้ามาที่นี่ -->
        </tbody>
    </table>

    <!-- กลุ่มโรงพยาบาลขนาดกลาง -->
    <h2>โรงพยาบาลขนาดกลาง (31-90 เตียง)</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>ชื่อโรงพยาบาล</th>
                <th>จำนวนเตียง</th>
                <th>ขนาดใหญ่</th>
                <th>ขนาดกลาง</th>
                <th>ขนาดเล็ก</th>
            </tr>
        </thead>
        <tbody id="mediumHospitalTableBody">
            <!-- ข้อมูลโรงพยาบาลขนาดกลางจะถูกเติมเข้ามาที่นี่ -->
        </tbody>
    </table>

    <!-- กลุ่มโรงพยาบาลขนาดเล็ก -->
    <h2>โรงพยาบาลขนาดเล็ก (ไม่เกิน 30 เตียง)</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>ชื่อโรงพยาบาล</th>
                <th>จำนวนเตียง</th>
                <th>ขนาดใหญ่</th>
                <th>ขนาดกลาง</th>
                <th>ขนาดเล็ก</th>
            </tr>
        </thead>
        <tbody id="smallHospitalTableBody">
            <!-- ข้อมูลโรงพยาบาลขนาดเล็กจะถูกเติมเข้ามาที่นี่ -->
        </tbody>
    </table>
</body>
</html>
