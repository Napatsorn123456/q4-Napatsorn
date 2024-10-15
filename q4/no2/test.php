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
            let result = document.getElementById('hospitalTableBody'); // ดึง tbody เพื่อนำข้อมูลไปแสดงในตาราง

            for (let i = 0; i < objectData.features.length; i++) {
                let hospitalName = objectData.features[i].properties.name;
                let numBeds = objectData.features[i].properties.num_bed;

                // สร้างแถวในตาราง
                let row = document.createElement('tr');
                
                // สร้างคอลัมน์สำหรับลำดับ, ชื่อโรงพยาบาล และขนาดของโรงพยาบาล
                let cellNo = document.createElement('td');
                let cellName = document.createElement('td');
                let cellLarge = document.createElement('td');
                let cellMedium = document.createElement('td');
                let cellSmall = document.createElement('td');

                // เพิ่มลำดับที่
                cellNo.innerText = i + 1;

                // เพิ่มชื่อโรงพยาบาล
                cellName.innerText = hospitalName;

                // เช็คขนาดของโรงพยาบาลและแสดงเครื่องหมาย ✓ ในช่องที่ตรงกับขนาดของโรงพยาบาล
                if (numBeds >= 91) {
                    cellLarge.innerHTML = '✓';
                } else if (numBeds >= 31) {
                    cellMedium.innerHTML = '✓';
                } else {
                    cellSmall.innerHTML = '✓';
                }

                // เพิ่มคอลัมน์เข้าในแถว
                row.appendChild(cellNo);
                row.appendChild(cellName);
                row.appendChild(cellLarge);
                row.appendChild(cellMedium);
                row.appendChild(cellSmall);

                // เพิ่มแถวลงใน tbody ของตาราง
                result.appendChild(row);
            }
        }

        getDataFromAPI(); // เรียกฟังก์ชันเพื่อดึงข้อมูล
    </script>
</head>
<body>
    <h1>รายชื่อโรงพยาบาลเอกชนในกรุงเทพฯ</h1>

    <!-- ตารางแสดงผลรายชื่อโรงพยาบาล -->
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>ชื่อโรงพยาบาล</th>
                <th>ขนาดใหญ่</th>
                <th>ขนาดกลาง</th>
                <th>ขนาดเล็ก</th>
            </tr>
        </thead>
        <tbody id="hospitalTableBody">
            <!-- แถวข้อมูลจะถูกเติมเข้ามาใน tbody นี้ -->
        </tbody>
    </table>
</body>
</html>
