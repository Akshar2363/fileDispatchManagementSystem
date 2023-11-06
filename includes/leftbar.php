<script>

function addFolder(){
    let folderName = prompt('Folder Name');
    if(folderName!=null){
        $.ajax({
            type: 'GET',
            url: `ajaxCalls/addFolder.php?folderName=${folderName}`,
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    }
}
function addFile() {
    const formData = new FormData(document.getElementById("fileUploadForm"));
    
    $.ajax({
        type: 'POST',
        url: 'ajaxCalls/addFile.php',
        data: formData,
        processData: false, 
        contentType: false, 
        success: function(response) {
            alert(response);
            location.reload();
        }
    });
}

</script>

<div class="leftbar sticky w-full h-fit lg:h-full flex flex-col bg-gray-800 text-white">
    <a class="p-4 hover:bg-gray-400 " href="dashboard.php">Dashboard</a>
    <div onclick="addFolder()" class="createFolder hover:bg-gray-400 flex flex-row gap-3">
        <p >Create Folder</p>
    </div>
    <div class="uploadFile hover:bg-gray-400 ">
        <p>Upload File</p>
        <form id="fileUploadForm" class="p-4 flex flex-row gap-3" enctype="multipart/form-data">
            <input type="file" name='fileupload' id='fileupload' class="text-white" placeholder="Upload File" class="text-black p-2">
        </form>
        <button onclick="addFile()">Submit</button>
    </div>
</div>