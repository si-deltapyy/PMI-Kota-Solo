$(document).ready(function () {
    // Function to fetch data based on role and status
    function fetchData(role, status) {

        let baseUrl = `/${role}/select-${urlBase}`; // Construct baseUrl
        console.log('baseUrl:', baseUrl); // Log baseUrl

        $.ajax({
            url: baseUrl,
            type: 'GET',
            data: { status: status },
            success: function (data) {
                console.log('Data received:', data); // Log data received
                const tbody = $('#data-table tbody');
                tbody.empty(); // Clear previous data

                data.forEach((item, index) => {
                    let waktuKejadian = formatDateTime(item.timestamp_report); // Format timestamp
                    let formattedTanggal = waktuKejadian.date;
                    let formattedWaktu = waktuKejadian.time;
                    let formattedUpdatedAt = formatDateTime(item.updated_at);

                    let statusClass = '';
                    switch (item.status) {
                        case 'Belum Diverifikasi':
                            statusClass = 'btn-danger';
                            break;
                        case 'On Process':
                            statusClass = 'btn-warning';
                            break;
                        case 'Selesai':
                            statusClass = 'btn-success';
                            break;
                        default:
                            statusClass = 'btn-secondary'; // Default or fallback class
                            break;
                    }

                    // Construct table row based on role-specific content
                    let tableRow = '';
                    switch (role) {
                        case 'relawan':
                            tableRow = `
                                <tr class="${item.status === 'Selesai' ? 'text-muted' : ''}">
                                    <td>${index + 1}</td>
                                    <td>${item.nama_kejadian}</td>
                                    <td>${item.locationName}</td>
                                    <td>${formattedTanggal}</td>
                                    <td>${formattedWaktu}</td>
                                    <td>${formattedUpdatedAt.date + " - " + formattedUpdatedAt.time}</td>
                                    <td><p class="btn ${statusClass} btn-sm">${item.status}</p></td>
                                    <td>
                                        <a href="/${role}/laporan-kejadian/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                                        ${item.status === 'Belum Diverifikasi'
                                    ? `<a href="/${role}/${urlBase}/edit/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                                               <button class="btn btn-danger btn-sm delete-item" data-id="{{ $item->id }}">
                                                    <i class="menu-icon mdi mdi-delete"></i>
                                                </button>`
                                    : `<a href="/${role}/${urlBase}/edit/${item.id}" class="btn btn-info btn-sm disabled"><i class="menu-icon mdi mdi-border-color"></i></a>
                                               <a href="/${role}/${urlBase}/delete/${item.id}" class="btn btn-danger btn-sm disabled"><i class="menu-icon mdi mdi-delete"></i></a>`
                                }
                                    </td>
                                </tr>
                            `;
                            break;
                        case 'admin':
                            tableRow = `
                                <tr class="${item.status === 'Selesai' ? 'text-muted' : ''}">
                                    <td>${index + 1}</td>
                                    <td>${item.nama_kejadian}</td>
                                    <td>${item.locationName}</td>
                                    <td>${formattedTanggal}</td>
                                    <td>${formattedWaktu}</td>
                                    <td>${formattedUpdatedAt.date + " - " + formattedUpdatedAt.time}</td>
                                    <td><p class="btn ${statusClass} btn-sm">${item.status}</p></td>
                                    <td>
                                    ${item.status === 'Belum Diverifikasi'
                                    ?
                                    `<a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                                        <a href="/${role}/${urlBase}/verif/${item.id}" class="btn btn-success btn-sm"><i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i></a>`
                                    :
                                    `<a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>`
                                }
                                    </td>
                                </tr>
                            `;
                            break;
                        case 'pengelola-profil':
                            tableRow = `
                                <tr class="${item.status === 'Selesai' ? 'text-muted' : ''}">
                                    <td>${index + 1}</td>
                                    <td>${item.nama_kejadian}</td>
                                    <td>${item.keterangan}</td>
                                    <td>${formattedTanggal}</td>
                                    <td>${formattedWaktu}</td>
                                    <td>${formattedUpdatedAt.date + " - " + formattedUpdatedAt.time}</td>
                                    <td><p class="btn ${statusClass} btn-sm">${item.status}</p></td>
                                    <td>
                                        <a href="/${role}/laporan-kejadian/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                                        ${item.status === 'Belum Diverifikasi'
                                    ? `<a href="/${role}/${urlBase}/edit/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                                               <a href="/${role}/${urlBase}/delete/${item.id}" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></a>`
                                    : `<a href="/${role}/${urlBase}/edit/${item.id}" class="btn btn-info btn-sm disabled"><i class="menu-icon mdi mdi-border-color"></i></a>
                                               <a href="/${role}/${urlBase}/delete/${item.id}" class="btn btn-danger btn-sm disabled"><i class="menu-icon mdi mdi-delete"></i></a>`
                                }
                                    </td>
                                </tr>
                            `;
                            break;
                        default:
                            console.error(`Invalid role: ${role}`);
                            return;
                    }

                    tbody.append(tableRow); // Append constructed table row
                });
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            }
        });
    }

    // Function to format ISO timestamp to formatted date and time
    function formatDateTime(isoTimestamp) {
        let dateObject = new Date(isoTimestamp);
        let day = dateObject.getDate();
        let month = dateObject.getMonth() + 1; // Month is zero-based
        let year = dateObject.getFullYear();
        let hours = dateObject.getHours();
        let minutes = dateObject.getMinutes();
        let seconds = dateObject.getSeconds();

        // Ensure two-digit formatting with leading zeros
        let formattedDate = `${day.toString().padStart(2, '0')}/${month.toString().padStart(2, '0')}/${year}`;
        let formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        return { date: formattedDate, time: formattedTime };
    }

    // Event handler for dropdown item click
    $('.dropdown-menu .dropdown-item').on('click', function () {
        const status = $(this).data('status');
        fetchData(userRole, status); // Fetch data based on userRole
    });


    // Fetch all data on page load with default status ''
    fetchData(userRole, '');

});
