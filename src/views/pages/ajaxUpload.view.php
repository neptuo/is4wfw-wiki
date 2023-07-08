<edit:execute>
    <web:out if:true="edit:saved">
        <utils:concat output="var:uploadFileId" separator="," value1="fa:uploadFileId" />
        <fileUrl:declare name="uploadFile" id="var:uploadFileId" />
    </web:out>

    <fa:upload dirId="var:wiki.upload.id">
        <ui:filebox name="file" />
    </fa:upload>
</edit:execute>

<web:out if:stringEmpty="fileUrl:uploadFile" if:not="true">
    <json:output>
        <json:object>
            <json:key name="url" value="fileUrl:uploadFile" />
        </json:object>
    </json:output>
</web:out>