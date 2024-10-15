<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อโรงพยาบาลเอกชนในกรุงเทพฯ</title>
    <script>
        let hospitalData = [];

        async function getDataFromAPI() {
            let response = await fetch('http://202.44.40.193/~aws/JSON/priv_hos.json');
            let rawData = await response.text(); // อ่านผลลัพธ์
            let objectData = JSON.parse(rawData); // แปลผลลัพธ์เป็น object
            hospitalData = objectData.features; // เก็บข้อมูลโรงพยาบาลในตัวแปร global

            
                

            populateDropDown(); // เรียกฟังก์ชันเพื่อเติม Drop-down List
        }

        function populateDropDown() {
            let dropdown = document.getElementById('hospitalDropdown');

            hospitalData.forEach(hospital => {
                let option = document.createElement('option');
                option.value = hospital.properties.name;
                option.textContent = hospital.properties.name;
                dropdown.appendChild(option);
            });
        }

        function displaySelectedHospital() {
            let selectedHospitalName = document.getElementById('hospitalDropdown').value;
            let displayArea = document.getElementById('selectedHospitalInfo');
            displayArea.innerHTML = ''; // ล้างข้อมูลเก่า

            if (selectedHospitalName) {
                let selectedHospital = hospitalData.find(hospital => hospital.properties.name === selectedHospitalName);
                if (selectedHospital) {
                    let numBeds = selectedHospital.properties.num_bed;
                    let info = `<h2>ข้อมูลโรงพยาบาล: ${selectedHospitalName}</h2>
                                <p>จำนวนเตียง: ${numBeds} เตียง</p>`;
                    displayArea.innerHTML = info;
                }
            }
        }

        getDataFromAPI(); // เรียกฟังก์ชันเพื่อดึงข้อมูล
    </script>
</head>
<body>
    <h1>รายชื่อโรงพยาบาลเอกชนในกรุงเทพฯ</h1>

    <!-- Drop-down List สำหรับเลือกโรงพยาบาล -->
    <label for="hospitalDropdown">เลือกโรงพยาบาล:</label>
    <select id="hospitalDropdown" onchange="displaySelectedHospital()">
        <option value="">-- กรุณาเลือกโรงพยาบาล --</option>
        <!-- ตัวเลือกโรงพยาบาลจะถูกเติมเข้ามาที่นี่ -->
    </select>

    <div id="selectedHospitalInfo"></div>
</body>
</html>
