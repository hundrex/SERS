<form method=POST action="./controller/page/user_create.php">
    <div class="form-group">
        <label for="label">Label</label>
        <input type="text" class="form-control" id="label" name="label" required placeholder="e.g. Web Development">
    </div>
    <div class="form-group">
        <label for="moduleNumber">Module number</label>
        <input type="text" class="form-control" id="moduleNumber" name="moduleNumber" required placeholder="e.g. 10">
    </div>
    <div class="form-group">
        <label for="descriptionModule">Description</label>
        <textarea rows="3" type="text" class="form-control" id="descriptionModule" name="descriptionModule" 
                  required placeholder="e.g. This course will teach you [...] about web development."></textarea>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Assignment
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="assignmentLabel">Label</label>
                <input type="text" class="form-control" id="assignmentLabel" name="assignmentLabel" required
                       placeholder="e.g. Website project">
            </div>
            <div class="form-group">
                <label for="assignmentDescription">Description</label>
                <textarea rows="3" type="text" class="form-control" id="assignmentDescription" 
                          name="assignmentDescription" 
                          required placeholder="e.g. This project will consist of..."></textarea>
            </div>
            <div class="form-group">
                <label for="assignmentDate">Due date <span class="form-comment">(Optional)</span></label>
                <input type="date" class="form-control" id="assignmentDate" name="assignmentDate" required
                       placeholder="e.g. 17/12/2015">
            </div>
            <div class="form-group">
                <label for="assignmentRetryPrice">Retry price <span class="form-comment">(Optional)</span></label>
                <input type="text" class="form-control" id="assignmentRetryPrice" name="assignmentRetryPrice" required
                       placeholder="e.g. 10">
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Exam
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="examLabel">Label</label>
                <input type="text" class="form-control" id="examLabel" name="examLabel" required
                       placeholder="e.g. Website project">
            </div>
            <div class="form-group">
                <label for="examDescription">Description</label>
                <textarea rows="3" type="text" class="form-control" id="examDescription" name="examDescription" 
                          required placeholder="e.g. This exam will be on..."></textarea>
            </div>
            <div class="form-group">
                <label for="examDate">Due date <span class="form-comment">(Optional)</span></label>
                <input type="date" class="form-control" id="examDate" name="examDate" required
                       placeholder="e.g. 26/12/2015">
            </div>
            <div class="form-group">
                <label for="examRetryPrice">Retry price <span class="form-comment">(Optional)</span></label>
                <input type="text" class="form-control" id="examRetryPrice" name="examRetryPrice" required
                       placeholder="e.g. 10">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>