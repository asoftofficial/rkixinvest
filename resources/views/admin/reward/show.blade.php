@extends('admin.layouts.default')
@push('style')
    <style>
        .content-wrapper {
            background: #fff;
        }
        .content {
            margin: 0;
            padding: 0 !important;
            padding-bottom: 35px !important;
        }
        .issue-title-section {
            background: #f4f6f9;
            padding: 20px 5px 0 55px;
        }
        .issue-page-title {
            position: relative;
            top: 7px;
            font-weight: bold;
        }
        .pdf_viewer, .pdf_container{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            position: relative;
        }
        .pdf_viewer{
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: scroll;
        }
        canvas#pdf_renderer {
            margin-top: 30px;
        }
        #navigation_controls {
            margin-top: 10px;
        }
        #navigation_controls button {
            background: var(--blue);
            border: none;
            color: #fff;
            font-weight: bold;
            padding: 5px 12px;
        }
        input#current_page {
            width: 40px;
            text-align: center;
            margin: 0 10px;
        }
        #zoom_controls{
            position: absolute;
            top: 15px;
        }
        #zoom_controls button {
            border: none;
            background: #fff;
            box-shadow: 1px 1px 5px rgb(0 0 0 / 20%);
            padding: 5px 15px;
            font-size: 18px;
            border-radius: 50%;
            font-weight: bold;
        }
        button#zoom_in {
            margin-right: 10px;
        }
        button.next-btn {
            height: 40px;
            border: none;
            border-radius: 10px;
            padding: 0;
            box-sizing: border-box;
            padding-right: 20px;
            background: var(--gray);
            color: #fff;
            font-size: 12.5px;
        }
        span.next-btn-icon {
            background: var(--blue);
            padding: 12px 15px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            margin-right: 20px;
            color: #fff;
        }
        a.back-link {
            color: var(--gray);
            font-weight: bold;
            position: absolute;
            top: 7%;
            left: 1%;
        }
    </style>
@endpush

@section('content')
    {{--    Page Section Title Area    --}}
    <div class="issue-title-section">
        <h2 class="issue-page-title">Issues</h2>
    </div>
    {{--    End Page Section Title Area    --}}
    <div class="container-fluid">
        <section class="issue">
            <div id="my_pdf_viewer" class="pdf_viewer">
                <div id="canvas_container" class="pdf_container">
                    <a href="#" class="back-link">Back</a>
                    <canvas id="pdf_renderer"></canvas>
                    <button class="next-btn">
                        <span class="next-btn-icon">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        Next Page
                    </button>
                </div>
                <div id="navigation_controls">
                    <div id="navigation_controls">
                        <button id="go_previous"><</button>
                        <input id="current_page" value="1" type="number"/> / <span id="totalPages"></span>
                        <button id="go_next" class="go_next">></button>
                    </div>
                </div>
                <div id="zoom_controls">
                    <button id="zoom_in">+</button>
                    <button id="zoom_out">-</button>
                </div>
            </div>
        </section>
    </div>


@endsection
@push('script')
    <script
    src="http://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
    </script>
    <script>
        var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
        var pages = 0;
        var file = "{{asset($issue->file_path)}}";
        pdfjsLib.getDocument(file).then((pdf) => {

            myState.pdf = pdf;
             pages = myState.pdf._pdfInfo.numPages;
            $("#totalPages").text(pages);
            console.log(pages);

            render();

        });

        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {

                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');

                var viewport = page.getViewport(myState.zoom);

                canvas.width = viewport.width;
                canvas.height = viewport.height;

                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }


        document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage == 1)
              return;
            myState.currentPage -= 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });

        document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages)
               return;
            myState.currentPage += 1;
            if(myState.currentPage <= pages){
                document.getElementById("current_page").value = myState.currentPage;
                render();
            }


        });



        document.getElementById('zoom_in').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom += 0.5;
            render();
        });

        document.getElementById('zoom_out').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom -= 0.5;
            render();
        });
        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;

            var code = (e.keyCode ? e.keyCode : e.which);

            if(code == 13) {
                var desiredPage =
                document.getElementById('current_page').valueAsNumber;

                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page").value = desiredPage;
                    render();
                }
            }
        });
    </script>
@endpush
