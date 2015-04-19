<?php
/**
 * Created by PhpStorm.
 * User: Wes
 * Date: 4/19/2015
 * Time: 9:52 AM
 */


$this->title = 'Contact Me';
?>


[[NAV]]

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-main">
                <form id="contact-me" action="">
                    <div class="form-group">
                        <label for="">Reason for Contact:</label>
                        <select name="reason" class="form-control">
                            <option value="general">General Inquiry</option>
                            <option value="design">Design Request</option>
                            <option value="info">More Information</option>
                            <option value="example">Work Example Request</option>
                            <option value="feedback">Design Feedback</option>
                            <option value="testimonial">Testimonial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Email (if you want a response):</label>
                        <input type="text" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Send!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>