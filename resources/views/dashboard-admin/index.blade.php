<x-dashboard-admin>
    <!-- Card Star -->
    <div class="container-fluid pt-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-box-open fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Products</p>
                        <h6 class="mb-0">{{$products}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-shopping-bag fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Orders</p>
                        <h6 class="mb-0">234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-shopping-cart fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Products Sold</p>
                        <h6 class="mb-0">567</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Customers</p>
                        <h6 class="mb-0">200</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Card End -->

    {{-- Chart Star --}}
    <div class="container-fluid pt-4">
        <div class="row g-4">
            <!-- Single Line Chart -->
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Single Line Chart</h6>
                    <canvas id="line-chart"></canvas>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4 d-flex flex-column justify-content-center align-items-center">
                    <h6 class="mb-4 text-center">Pie Chart</h6>
                    <div class="chart-container" style="position: relative; width: 100%; max-width: 400px;">
                        <canvas id="pie-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Chart End --}}


    <!-- Table Start -->
    <div class="container-fluid pt-4 mb-5">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Salse</h6>
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col"><input class="form-check-input" type="checkbox"></th>
                            <th scope="col">Date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Table End -->

</x-dashboard-admin>
<x-script-admin>
 <script>
    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        const red = Math.floor(Math.random() * 256);
        const green = Math.floor(Math.random() * 256);
        const blue = Math.floor(Math.random() * 256);

        const pastelRed = Math.floor((red + 255) / 2);
        const pastelGreen = Math.floor((green + 255) / 2);
        const pastelBlue = Math.floor((blue + 255) / 2);

        return `rgb(${pastelRed}, ${pastelGreen}, ${pastelBlue})`;
    }

    var ctxLine = document.getElementById('line-chart').getContext('2d');
    var lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Sales',
                data: [30, 50, 40, 60, 80, 100],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data for Pie Chart
    var categories = @json($categories);
    var counts = @json($counts);

    console.log(categories);
    console.log(counts);

    // Membuat array warna acak berdasarkan jumlah kategori
    var backgroundColors = categories.map(() => getRandomColor());
    var borderColors = categories.map(() => getRandomColor());

    var ctxPie = document.getElementById('pie-chart').getContext('2d');
    var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: categories,
            datasets: [{
                data: counts,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>

</x-script-admin>