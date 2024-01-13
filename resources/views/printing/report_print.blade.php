<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> {{ $title }} </title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,400;1,500&display=swap');

        .report-box {
            max-width: 800px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        ::selection {background: #f31544; color: #FFF;}
        ::moz-selection {background: #f31544; color: #FFF;}

        h2{font-size: .9em;}

        table{
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE
        }
        .table-title {
            padding: 5px;
            background: #EEE;
        }
        .table-row { border: 1px solid #EEE; }
        .item-text {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        .content.page-break {
            page-break-before: always;
        }

        @media print {
            @page {
                size: 'A4'; /* You can try 'auto' or specific paper sizes like 'letter', 'A4', etc. */
                margin-top: 0; /* Try setting margins to 0 to maximize space */
                margin-bottom: 0;
                margin-left: 1;
                margin-right: 1;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }

        .report-header-container {
            border-bottom: 2px solid;
            padding: 1em 0em;
            margin-bottom: 5px;
            font-family: 'Ubuntu', sans-serif;
            font-size: 14px;
            color: black;
        }

        .report-footer-text {
            text-align: right;
            font-size: 12px;
            color: white;
            font-weight: 100;
            background: darkgray;
        }
    </style>
</head>

<body>
    <div class="report-box" id="page-drawing-area">
        <div class="header" id="header-container">
            @if(View::exists('lara_report_craft.partiel.header'))
                @include('lara_report_craft.partiel.header')
            @else
                @include('lara_report_craft::printing.partiel.header')
            @endif
        </div>

        <div class="footer" id="footer-container">
            @if(View::exists('lara_report_craft.partiel.footer'))
                @include('lara_report_craft.partiel.footer')
            @else
                @include('lara_report_craft::printing.partiel.footer')
            @endif
        </div>
    </div>
</body>

<script>
    // Function to create multi-page document
    /*function createMultiPageDocument() {
        // Define header and footer height
        const headerHeight = 20;
        const footerHeight = 20;
        const pageMaxHeight = 1020;
        const tableData = @ json($data);
        const columns = @ json($columns);

        const headerHtml = document.getElementById('header-container').innerHTML;
        const footerHtml = document.getElementById('footer-container').innerHTML;
        const area = document.getElementById('page-drawing-area');

        area.innerHTML = "";

        const rowHeight = 50;
        const numRows = tableData.length - 9;
        const tableHeight = numRows * rowHeight;

        // Calculate body height excluding header and footer
        const bodyHeight = pageMaxHeight - headerHeight - footerHeight;

        // Calculate the number of pages needed
        const nPages = (tableHeight + headerHeight + footerHeight) / bodyHeight;
        const numPages = Math.ceil(nPages);

        console.log({ bodyHeight, numPages, nPages })
        let rowsCount = 0;

        // Loop through pages
        for (let page = 1; page <= numPages; page++) {
            console.log({ res: 'new page drawing' });
            // Create a new <div> element representing a page
            let pageDiv = document.createElement('div');
            pageDiv.classList.add('page');
            pageDiv.classList.add('content');
            pageDiv.classList.add('page-break');
            area.appendChild(pageDiv);

            // Add header to the page
            let headerDiv = document.createElement('div');
            headerDiv.innerHTML = headerHtml;
            pageDiv.appendChild(headerDiv);

            // add table to the body
            let tableBody = document.createElement('table');
            pageDiv.appendChild(tableBody);

            if (page === 1) {
                let rowDiv = document.createElement('tr');
                rowDiv.classList.add('heading');

                for (let j = 0; j < columns.length; j++) {
                    const col = columns[j];
                    let cellDiv = document.createElement('td');
                    cellDiv.textContent = col.title;
                    rowDiv.appendChild(cellDiv);
                }
                tableBody.appendChild(rowDiv);
            }

            // Draw the table on the current page
            for (let i = rowsCount; i < numRows && pageDiv.clientHeight + rowHeight < bodyHeight; i++) {
                // Add row to the page
                let rowDiv = document.createElement('tr');
                rowDiv.classList.add('details');
                const row = tableData[i];
                rowsCount = i;

                for (let j = 0; j < columns.length; j++) {
                    const col = columns[j];
                    let cellDiv = document.createElement('td');
                    cellDiv.textContent = row[col.field];
                    rowDiv.appendChild(cellDiv);
                }
                tableBody.appendChild(rowDiv);
            }

            // Add footer to the page
            let footerDiv = document.createElement('div');
            footerDiv.innerHTML = footerHtml;
            pageDiv.appendChild(footerDiv);
        }
    }

    // Call the function to create the document
    createMultiPageDocument();*/
</script>

<script>
    let tableData = @json($data);
    let columns = @json($columns);
</script>

<script src="{{ asset('vendor/lara-report-craft/js/printing.js') }}"></script>

<script>

    // Function to create multi-page document
    /*function createMultiPageDocument() {
        // Define header and footer height
        const headerHeight = document.getElementById('header-container').clientHeight;
        const footerHeight = document.getElementById('footer-container').clientHeight;

        const pageMaxHeight = 960;
        const tableData = @ json($data);
        const columns = @ json($columns);

        const headerHtml = document.getElementById('header-container').innerHTML;
        const footerHtml = document.getElementById('footer-container').innerHTML;
        const area = document.getElementById('page-drawing-area');

        area.innerHTML = "";

        const numRows = tableData.length;

        // Calculate body height excluding header and footer
        const bodyHeight = pageMaxHeight - (headerHeight + footerHeight);

        let rowsCount = 0;

        let pageDiv = document.createElement('div');
        pageDiv.classList.add('page');
        pageDiv.classList.add('content');
        pageDiv.classList.add('page-break');
        area.appendChild(pageDiv);

        // Add header to the page
        let headerDiv = document.createElement('div');
        headerDiv.innerHTML = headerHtml;
        pageDiv.appendChild(headerDiv);

        // Add footer to the page
        let footerDiv = document.createElement('div');
        footerDiv.innerHTML = footerHtml;

        // add table to the body
        let tableBody = document.createElement('table');
        pageDiv.appendChild(tableBody);

        let rowDiv = document.createElement('tr');
        rowDiv.classList.add('table-title');

        for (let j = 0; j < columns.length; j++) {
            const col = columns[j];
            let cellH = document.createElement('h2');
            cellH.textContent = col.title;
            let cellDiv = document.createElement('td');
            cellDiv.appendChild(cellH);
            rowDiv.appendChild(cellDiv);
        }
        tableBody.appendChild(rowDiv);

        // Loop through pages
        for (let i = rowsCount; i < numRows; i++) {
            // Add row to the page
            let rowElement = document.createElement('tr');
            rowElement.classList.add('table-row');
            const row = tableData[i];
            rowsCount = i;

            for (let j = 0; j < columns.length; j++) {
                const col = columns[j];
                let cellDiv = document.createElement('td');
                cellDiv.classList.add('item-text');
                cellDiv.textContent = row[col.field];
                rowElement.appendChild(cellDiv);
            }
            tableBody.appendChild(rowElement);
            const rowHeight = rowElement.clientHeight;

            if (pageDiv.clientHeight > bodyHeight + (headerHeight + rowHeight)) {
                // remove the last row added
                tableBody.removeChild(rowElement);
                // new page should be created
                // Add footer to the page
                let footerDiv = document.createElement('div');
                footerDiv.innerHTML = footerHtml;
                pageDiv.appendChild(footerDiv);

                pageDiv = document.createElement('div');
                pageDiv.classList.add('page');
                pageDiv.classList.add('content');
                pageDiv.classList.add('page-break');
                area.appendChild(pageDiv);

                // Add header to the page
                headerDiv = document.createElement('div');
                headerDiv.innerHTML = headerHtml;
                pageDiv.appendChild(headerDiv);

                // add table to the body
                tableBody = document.createElement('table');
                pageDiv.appendChild(tableBody);

                // Add row to the page
                let rowDiv = document.createElement('tr');
                rowDiv.classList.add('table-row');
                const row = tableData[i];
                rowsCount = i;

                for (let j = 0; j < columns.length; j++) {
                    const col = columns[j];
                    let cellDiv = document.createElement('td');
                    cellDiv.classList.add('item-text');
                    cellDiv.textContent = row[col.field];
                    rowDiv.appendChild(cellDiv);
                }
                tableBody.appendChild(rowDiv);
            }
        }

        pageDiv.appendChild(footerDiv);
    }

    // Call the function to create the document
    createMultiPageDocument();

    window.print();*/
</script>
</html>
