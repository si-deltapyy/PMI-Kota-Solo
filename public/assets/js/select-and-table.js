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
                        case 'Invalid':
                            statusClass = 'btn-danger';
                            break;
                        case 'On Process':
                            statusClass = 'btn-warning';
                            break;
                        case 'Aktif':
                            statusClass = 'btn-success';
                            break;
                        case 'Valid':
                            statusClass = 'btn-success';
                            break;
                        case 'Selesai':
                            statusClass = 'btn-info';
                            break;
                        default:
                            statusClass = 'btn-secondary'; // Default or fallback class
                            break;
                    }

                    // Construct table row based on role-specific content
                    let tableRow = '';
                    switch (role) {
                        case 'relawan':
                            if (urlBase == "laporan-kejadian") {
                                tableRow = `
                                <tr class="${item.status === 'Valid' ? 'text-muted' : ''}">
                                    <td>${index + 1}</td>
                                    <td>${item.nama_kejadian}</td>
                                    <td>${item.locationName}</td>
                                    <td>${formattedTanggal}</td>
                                    <td>${formattedWaktu}</td>
                                    <td>${formattedUpdatedAt.date + " - " + formattedUpdatedAt.time}</td>
                                    <td><p class="btn ${statusClass} btn-sm">${item.status}</p></td>
                                    <td>
                                    ${item.status === 'On Process'
                                        ?
                                        `<a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                                        <a href="/${role}/${urlBase}/verif/${item.id}" class="btn btn-success btn-sm"><i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i></a>`
                                        :
                                        `<a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>`
                                    }
                                    </td>
                                </tr>
                            `;
                            } else {
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
                                        <a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                                        ${item.status == 'Aktif' | item.status == 'On Process'
                                        ? `<a href="/${role}/${urlBase}/edit/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                                               <button class="btn btn-danger btn-sm delete-item" data-id="${item.id}">
                                                    <i class="menu-icon mdi mdi-delete"></i>
                                                </button>`
                                        : `<a href="/${role}/${urlBase}/edit/${item.id}" class="btn btn-info btn-sm disabled"><i class="menu-icon mdi mdi-border-color"></i></a>
                                               <a href="/${role}/${urlBase}/delete/${item.id}" class="btn btn-danger btn-sm disabled"><i class="menu-icon mdi mdi-delete"></i></a>`
                                    }
                                    </td>
                                </tr>
                            `;
                            }
                            break;
                        case 'admin':
                            if (urlBase == "laporan-kejadian") {
                                tableRow = `
                                <tr class="${item.status === 'Valid' ? 'text-muted' : ''}">
                                    <td>${index + 1}</td>
                                    <td>${item.nama_kejadian}</td>
                                    <td>${item.locationName}</td>
                                    <td>${formattedTanggal}</td>
                                    <td>${formattedWaktu}</td>
                                    <td>${formattedUpdatedAt.date + " - " + formattedUpdatedAt.time}</td>
                                    <td><p class="btn ${statusClass} btn-sm">${item.status}</p></td>
                                    <td>
                                        <a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                                        ${item.status === 'On Process'
                                        ? `<a href="/${role}/${urlBase}/edit/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                                               <button class="btn btn-danger btn-sm delete-item" data-id="${item.id}">
                                                    <i class="menu-icon mdi mdi-delete"></i>
                                                </button>`
                                        : `<a href="/${role}/${urlBase}/edit/${item.id}" class="btn btn-info btn-sm disabled"><i class="menu-icon mdi mdi-border-color"></i></a>
                                               <a href="/${role}/${urlBase}/delete/${item.id}" class="btn btn-danger btn-sm disabled"><i class="menu-icon mdi mdi-delete"></i></a>`
                                    }
                                    </td>
                                </tr>
                            `;
                            }
                            else if (urlBase == "lapsit") {
                                const adminViewLapsitUrl = window.routes.adminViewLapsit.replace(':id', item.id);
                                const shareLapsitUrl = window.routes.shareLapsit.replace(':id', item.id);
                                tableRow = `
                                <tr class="${item.status === 'Selesai' ? 'text-muted' : ''}">
                                    <td>${index + 1}</td>
                                    <td>${item.nama_kejadian}</td>
                                    <td>${item.locationName}</td>
                                    <td>${formattedTanggal}</td>
                                    <td>${formattedWaktu}</td>
                                    <td>${formattedUpdatedAt.date} - ${formattedUpdatedAt.time}</td>
                                    <td><p class="btn ${statusClass} btn-sm">${item.status}</p></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="${adminViewLapsitUrl}" class="btn btn-info btn-sm me-2">
                                                <i class="menu-icon mdi mdi-information"></i>
                                            </a>
                                            <form action="${shareLapsitUrl}" method="post">
                                                <input type="hidden" name="_token" value="${window.csrfToken}">
                                                <button class="btn btn-success text-white me-0 btn-sm">
                                                    <i class="mdi mdi-whatsapp"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            `;
                            }
                            else {
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
                                    ${getStatusButtons(role, urlBase, item)}
                                    </td>
                                </tr>
                            `;
                            }
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
                                        <a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
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

    // Function to delete data
    function deleteData(itemId) {
        // Send DELETE request via AJAX
        $.ajax({
            url: `/${userRole}/${urlBase}/delete/${itemId}`, // Use role and urlBase variables
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response, textStatus, xhr) {
                console.log('Item deleted successfully:', response);
                window.location.reload(true);

                // Check if the response is a redirect
                if (xhr.getResponseHeader('content-type').indexOf('text/html') !== -1) {
                    // Handle redirect scenario by reloading the page
                    alert('Item deleted successfully. Page will reload.');
                    window.location.href = window.location.href; // Reload the page
                } else {
                    // Handle JSON response scenario (if applicable)
                    // Remove the table row or update the UI as needed
                    $(`#item-${itemId}`).remove(); // Example: assuming each row has an ID like item-1, item-2, etc.
                }
            },

            error: function (xhr) {
                console.error('Error deleting item:', xhr.responseText);
                if (xhr.status === 404) {
                    // Handle specific error if item not found
                    alert('Item not found. It may have already been deleted.');
                } else {
                    // Handle other errors
                    alert('Failed to delete item. Please try again.');
                }
            }
        });
    }


    // Event handler for delete button click
    $(document).on('click', '.delete-item', function (e) {
        e.preventDefault();

        let itemId = $(this).data('id');
        console.log('itemId', itemId)

        // Confirm deletion (optional)
        if (!confirm('Are you sure you want to delete this item?')) {
            return false;
        }

        deleteData(itemId);
    });

    // Other functions and event handlers as before...



    // Fetch all data on page load with default status ''
    fetchData(userRole, '');

});

// Define a function to return the appropriate HTML based on the status
function getStatusButtons(role, urlBase, item) {
    switch (item.status) {
        case 'On Process':
            return `<a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                    <a href="/${role}/${urlBase}/verif/${item.id}" class="btn btn-success btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                    <a href="/${role}/${urlBase}/selesai/${item.id}" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i></a>`
                ;
        case 'Aktif':
            return `
                <a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                <a href="/${role}/${urlBase}/selesai/${item.id}" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i></a>
            `;
        case 'Selesai':
            return `
                <a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
            `;
        default:
            return `<a href="/${role}/${urlBase}/view/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>`;
    }
}
