@extends('user.layouts.master')
@section('title', 'Transactions')

@section('content')


   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Main page styling */
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            margin-bottom: 15px;
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .transaction-amount {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .transaction-date {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .transaction-status {
            font-size: 0.85rem;
            margin-top: 5px;
        }
        .transaction-failed {
            color: #dc3545;
        }
        .transaction-successful {
            color: #28a745;
        }
        .btn-primary {
            background-color: #5E17EC;
            border: none;
        }
        .btn-primary:hover {
            background-color: #5D18EC;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        .back-arrow {
            font-size: 1.1rem;
            text-decoration: none;
            color: #000;
        }
        .back-arrow svg {
            margin-right: 8px;
        }
        /* Center the dropdown */
        .centered-select {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        /* Custom styling for the select dropdown */
        .custom-select-container {
            position: relative;
            max-width: 300px;
            width: 100%;
        }
        .custom-select {
            width: 100%;
            padding: 10px;
            border: 2px solid #22c55e;
            border-radius: 8px;
            background-color: #fff;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            font-weight: bold;
            color: #333;
        }
        .custom-select:focus {
            border-color: #25D366;
            box-shadow: 0px 0px 10px rgba(37, 211, 102, 0.5);
            outline: none;
        }
        /* Custom arrow icon */
        .custom-select-container::after {
            content: '\25BC'; /* Unicode for downward arrow */
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 1rem;
            color: #22c55e;
        }
        /* Style dropdown options */
        .custom-select option {
            padding: 10px;
            font-weight: normal;
            color: #22c55e;
            background-color: #fff;
        }
        .custom-select option:hover {
            background-color: #25D366;
            color: #fff;
        }
        .custom-select option:checked {
            background-color: #22c55e;
            color: #fff;
        }
        /* Modal styles */
        .modal-content {
            border-radius: 12px;
            padding: 20px;
        }
        .transaction-details-label {
            font-weight: bold;
            color: #333;
        }
        .transaction-details {
            font-size: 1rem;
            color: #6c757d;
            text-align: right;
        }
        .transaction-status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            text-align: right;
        }
        .transaction-successful {
            background-color: #d4edda;
            color: #22c55e;
        }
        .transaction-failed {
            background-color: #f8d7da;
            color: #721c24;
        }
        .separator {
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }
        /* button styles */
       /* Outline Button Style */
.btn-outline {
    padding: 10px 20px;
    border: 2px solid #22c55e; /* Blue border */
    background-color: transparent;
    color: #22c55e; /* Blue text */
    border-radius: 30px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-outline:hover {
    background-color: #f2f2f2; /* Light grey background on hover */
}

/* Solid Button Style */
.btn-solid {
    padding: 10px 20px;
    border: none;
    background-color: #22c55e; /* Blue background */
    color: #ffffff; /* White text */
    border-radius: 30px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-solid:hover {
    background-color: #22c55e; /* Darker blue on hover */
}


    /* Adjust button size */
    .btn-outline, .btn-solid {
        padding: 12px 25px; /* Increase the padding for larger buttons */
        border-radius: 40px; /* Make buttons more rounded */
        font-size: 18px; /* Increase font size */
    }

    /* Center the buttons in the modal footer */
    .modal-footer {
        display: flex;
        justify-content: center; /* Center the buttons */
        gap: 15px; /* Add spacing between buttons */
    }
/* Modal footer button styling */
.modal-footer {
    display: flex;
    justify-content: space-between; /* Add space between the buttons */
    gap: 15px; /* Add spacing between buttons */
    flex-wrap: nowrap; /* Ensure buttons remain on the same line */
    width: 100%; /* Make sure the buttons take the full width of the modal */
}

/* Button sizes */
.btn-outline, .btn-solid {
    flex: 1; /* Make both buttons take equal width */
    margin: 0 5px; /* Add small margin between buttons */
}

/* Adjust the font size for Share Receipt */
.btn-outline {
    font-size: 11px; /* Change this value as needed */
}

/* Adjust the font size for Report Issue */
.btn-solid {
    font-size: 11px; /* Change this value as needed */
}



    </style>
</head>
<body>
    <div class="container my-3">
        <!-- Back Arrow and Transaction History -->
        <a href="#" class="back-arrow d-flex align-items-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H3.707l4.147-4.146a.5.5 0 1 0-.708-.708l-5 5a.5.5 0 0 0 0 .708l5 5a.5.5 0 0 0 .708-.708L3.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Transaction History
        </a>

        <!-- Centered Transaction Type Dropdown -->
        <div class="centered-select">
            <div class="custom-select-container">
                <select class="custom-select" aria-label="Transaction Type Selection" onchange="filterTransactions(this.value)">
                    <option disabled selected>Select Transaction Type</option>
                    <option value="all">All</option>
                    <option value="airtime">Airtime</option>
                    <option value="electricity">Electricity</option>
                    <option value="cable-tv">Cable TV</option>
                    <option value="internet">Internet</option>
                </select>
            </div>
        </div>

        <!-- Transaction History -->
        <div id="transaction-list">
            <a href="#" class="transaction-card" data-type="airtime" data-bs-toggle="modal" data-bs-target="#transactionModal">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>Airtime Purchase</h5>
                                <p class="transaction-date">August 24, 2024 - 14:30</p>
                            </div>
                            <div class="text-end">
                                <div class="transaction-amount text-danger">- $10.00</div>
                                <div class="transaction-status transaction-successful">Successful</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Repeat for other transactions... -->
        </div>
    </div>

    <!-- Modal for Transaction Details -->
    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalLabel">Transaction Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 transaction-details-label">Transaction ID:</div>
                        <div class="col-6 transaction-details">FVV2G9PWSETD29</div>
                    </div>
                    <div class="separator"></div>

                    <div class="row">
                        <div class="col-6 transaction-details-label">Date:</div>
                        <div class="col-6 transaction-details">19 Jun, 2024 06:26pm</div>
                    </div>
                    <div class="separator"></div>

                    <div class="row">
                        <div class="col-6 transaction-details-label">Status:</div>
                        <div class="col-6 transaction-details">
                            <span class="transaction-status transaction-successful">Successful</span>
                        </div>
                    </div>
                    <div class="separator"></div>

                    <div class="row">
                        <div class="col-6 transaction-details-label">Amount:</div>
                        <div class="col-6 transaction-details">₦2,000.00</div>
                    </div>
                    <div class="separator"></div>

                    <div class="row">
                        <div class="col-6 transaction-details-label">Charge:</div>
                        <div class="col-6 transaction-details">₦0.00</div>
                    </div>
                    <div class="separator"></div>

                    <div class="row">
                        <div class="col-6 transaction-details-label">Total Amount:</div>
                        <div class="col-6 transaction-details">₦2,000.00</div>
                    </div>
                    <div class="separator"></div>

                    <div class="row">
                        <div class="col-6 transaction-details-label">From:</div>
                        <div class="col-6 transaction-details">+234 703 101 1010</div>
                    </div>
                    <div class="separator"></div>

                    <div class="row">
                        <div class="col-6 transaction-details-label">To:</div>
                        <div class="col-6 transaction-details">08033013138</div>
                    </div>
                </div>
                
                
       <div class="modal-footer">
                    <button class="btn-outline" id="shareBtn">Share
                    Receipt</button>
                    <button class="btn-solid" id="whatsappBtn">Report Issue
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- HTML2Canvas for Capturing Screenshot -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <script>
        // Share button functionality
        document.getElementById('shareBtn').addEventListener('click', function () {
            if (navigator.share) {
                navigator.share({
                    title: 'Transaction Receipt',
                    text: 'I just completed a transaction! Check the details:',
                    url: window.location.href  // or the URL of your receipt
                }).then(() => {
                    console.log('Thanks for sharing!');
                }).catch(err => {
                    console.log('Error sharing:', err);
                });
            } else {
                alert('Web Share API not supported in this browser.');
            }
        });

        // WhatsApp Share PNG to customer care functionality
        document.getElementById('whatsappBtn').addEventListener('click', function () {
            // Convert the pop-up content to PNG using html2canvas
            html2canvas(document.getElementById('receiptContent')).then(function (canvas) {
                // Convert the canvas to a data URL
                let imageData = canvas.toDataURL('image/png');
                
                // Create a temporary link element to download the PNG image
                let link = document.createElement('a');
                link.href = imageData;
                link.download = 'transaction-receipt.png';

                // Trigger the download automatically (optional)
                link.click();

                // Send the PNG to WhatsApp customer care (you can replace this with actual file-sharing logic)
                const customerCareNumber = '1234567890'; // Replace with your actual WhatsApp number (without +)
                const whatsappUrl = `https://api.whatsapp.com/send?phone=${customerCareNumber}&text=Hello%2C%20I%20have%20an%20issue%20with%20this%20transaction.%20Please%20find%20attached%20the%20receipt.`;

                // Open WhatsApp with pre-filled message
                window.open(whatsappUrl, '_blank');
            });
        });

        <!-- Sorting and Filtering Script -->
    <script>
        function filterTransactions(type) {
            const cards = document.querySelectorAll('.transaction-card');
            cards.forEach(card => {
                if (type === 'all' || card.getAttribute('data-type') === type) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }    
    </script>


    <!-- Bootstrap JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>


@endsection