	<!DOCTYPE html>
	<html lang="en">

	<head>
	  <title>Large File Upload</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	</head>

	<body>
	  <div class="container-fluid p-5 bg-primary text-white text-center">
	    <h1>
	      <center>Using Chunk To Upload Larger File</center>
	    </h1>
	  </div>


	  <div class="container mt-5">
	    <div class="row">
	      <div class="col-sm-12">
	        <form method="post" enctype="multipart/form-data">
	          <div class="text-center">
	            <input class="btn btn-primary" type="button" id="pickfiles" value="Cick Me to Bulk Upload" />
	          </div>

	          <div class="alert alert-success mt-3">
	            <div id="filelist" class="d-flex flex-column gap-3"></div>
	          </div>
	        </form>
	      </div>
	    </div>
	  </div>
	</body>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.3/plupload.full.min.js"></script>
	<script>
	  window.addEventListener("load", () => {
	    var filelist = document.getElementById("filelist");

	    var uploader = new plupload.Uploader({
	      runtimes: "html5",
	      browse_button: "pickfiles",
	      //url: "chunk.php",
	      url: "http://localhost/artoreal/m2/artoreal-m2/pub/rest/V1/files/bulk-upload",
	      chunk_size: "20Mb",
	      unique_names: true,
	      multipart: true,
	      multiple_queues: true,
	      autostart: true,
	      filters: {
	        max_file_size: "4gb",
	        mime_types: [{
	          title: "Image files",
	          extensions: "jpg,jpeg,tif,tiff"
	        }]
	      },
	      init: {
	        PostInit: () => {
	          filelist.innerHTML = "<div>Ready To Multiple File Uploading</div>";
	        },
	        FilesAdded: (up, files) => {
	          plupload.each(files, (file) => {
	            let row = document.createElement("div");
	            row.id = file.id;
	            row.innerHTML = `${file.name} (${plupload.formatSize(file.size)}) <strong></strong>`;
	            filelist.appendChild(row);
	          });
	          uploader.start();
	        },
	        UploadProgress: (up, file) => {
	          console.log("up", up, "file", file);
	          document.querySelector(`#${file.id} strong`).innerHTML = `${file.percent}%`;
	        },
	        Error: (up, err) => {
	          console.error(err);
	        },
	        BeforeUpload: function(up, file) {
	          // Called right before the upload for a given file starts, can be used to cancel it if required
	          console.log('[BeforeUpload]', 'File: ', file);

	          // photograp : framerprod
	          // painting : simple
	          up._options.params = {
	            "artist_id": "2",
	            "type": "framerprod",
				"sub_artist_id": 3,
	          };
	        },
	      }
	    });
	    uploader.init();
	  });
	</script>

	</html>