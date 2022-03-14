const department = document.getElementById('department');
const doctor = document.getElementById('doctor');


department.addEventListener('change', e => {
    $.ajax({
        url: "getDoctorName.php",
        type: 'POST',
        data: ({ department: JSON.stringify(department.value) }),
        success: function(data) {
            doctor.length = 0;
            data = JSON.parse(data);
            data.forEach(arr => {
                console.log(arr);
                let html = `<option value="${arr.id}">${arr.name}</option>`;
                doctor.insertAdjacentHTML('beforeend', html);
            });


        }
    });
});