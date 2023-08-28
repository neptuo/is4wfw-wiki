<list:declare name="pageMenu">
    <controls:pageUrl url="cepage:url" folderUrl="cepage:folder_id.url" type="view">
        <var:declare name="pageViewActive" value="template:isActive" />
        <web:condition when="var:pageViewActive" isInverted="true">
            <route:use name="home">
                <var:declare name="pageViewActive" value="route:isActive" />
            </route:use>
        </web:condition>
        <list:add key-iconPrefix="fa" key-icon="eye" key-url="template:pageUrl" key-text="View" key-isActive="var:pageViewActive" />
    </controls:pageUrl>
    <login:authorized any="wiki">
        <controls:pageUrl url="cepage:url" folderUrl="cepage:folder_id.url" type="edit">
            <list:add key-iconPrefix="fa" key-icon="pen" key-url="template:pageUrl" key-text="Edit" key-isActive="template:isActive" />
        </controls:pageUrl>
        <controls:pageUrl url="cepage:url" folderUrl="cepage:folder_id.url" type="history">
            <list:add key-iconPrefix="fas" key-icon="history" key-url="template:pageUrl" key-text="History" key-isActive="template:isActive" />
        </controls:pageUrl>
    </login:authorized>
    <controls:pageUrl url="cepage:url" folderUrl="cepage:folder_id.url" type="files">
        <list:add key-iconPrefix="fa" key-icon="file" key-url="template:pageUrl" key-text="Files" key-isActive="template:isActive" />
    </controls:pageUrl>
    <login:authorized any="wiki">
        <controls:pageUrl url="cepage:url" folderUrl="cepage:folder_id.url" type="delete">
            <list:add key-iconPrefix="fa" key-icon="trash-alt" key-url="template:pageUrl" key-text="Delete..." key-class="text-danger" key-isActive="template:isActive" />
        </controls:pageUrl>
    </login:authorized>
</list:declare>

<controls:stickyHeader separator="false">
    <div class="d-flex">
        <div class="flex-fill text-truncate px-2 pb-2 pb-sm-0">
            <h1 class="mb-0 text-truncate">
                <web:out text="cepage:title" />
            </h1>
        </div>
        <div class="dropdown d-sm-none">
            <bs:button color="link" data-toggle="dropdown" class="text-dark">
                <fa5:icon prefix="fas" name="ellipsis-v" />
            </bs:button>
            <div class="dropdown-menu dropdown-menu-right">
                <ui:forEach items="list:pageMenu">
                    <a href="<web:out text="list:pageMenu-url" />" class="dropdown-item <web:out text="list:pageMenu-class" />">
                        <fa5:icon prefix="list:pageMenu-iconPrefix" name="list:pageMenu-icon" />
                        <span>
                            <web:out text="list:pageMenu-text" />
                        </span>
                    </a>
                </ui:forEach>
            </div>
        </div>
    </div>
    <div class="d-block d-sm-flex align-items-end">
        <div class="flex-grow-1 border-bottom pb-2 px-2 d-none d-sm-block">
            <div>
                <web:condition when="cepage:folder_id.name">
                    <small class="mr-1">
                        <fa5:icon prefix="fas" name="folder" title="Folder" />
                        <php:set property="cefolder:linkUrl" value="cepage:folder_id.url" />
                        <web:a pageId="route:folder" text="cepage:folder_id.name" />
                    </small>
                </web:condition>
                <small class="mr-1 d-none d-md-inline">
                    <fa5:icon prefix="far" name="clock" title="Changed at" />
                    <ui:dateTimeValue value="cepage:changed_date" format="d.m.Y H:i:s" />
                </small>
                <web:condition when="cepage:is_public">
                    <small class="mr-1">
                        <fa5:icon name="user-secret" />
                        Public
                    </small>
                </web:condition>
                <web:condition when="cepage:is_archived">
                    <small class="mr-1">
                        <fa5:icon name="archive" />
                        Archived
                    </small>
                </web:condition>
            </div>
        </div>
        <div class="d-none d-sm-block">
            <bs:nav mode="tabs">
                <ui:forEach items="list:pageMenu">
                    <bs:navItem url="list:pageMenu-url" isActive="list:pageMenu-isActive" a-class="list:pageMenu-class">
                        <fa5:icon prefix="list:pageMenu-iconPrefix" name="list:pageMenu-icon" />
                        <span class="d-none d-lg-inline">
                            <web:out text="list:pageMenu-text" />
                        </span>
                    </bs:navItem>
                </ui:forEach>
            </bs:nav>
        </div>
    </div>
</controls:stickyHeader>