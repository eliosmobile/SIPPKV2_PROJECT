@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4">About Us</h1>
            <p class="lead">Welcome to our project! We are a dedicated team working on a Project-Based Learning initiative to create a Room Booking Information System.</p>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Our Team</h2>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-4">
                            <div class="team-member">
                                <div class="team-img-container">
                                    <img src="{{ asset('image/img1.jpg') }}" class="img-fluid" alt="Team Member 1">
                                </div>
                                <h4>Muhammad Rasyad</h4>
                                <p>Lead Developer, Project Manager, UI/UX, Front end & Back End</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="team-member">
                                <div class="team-img-container">
                                    <img src="{{ asset('image/img2.jpg') }}" class="img-fluid" alt="Team Member 2">
                                </div>
                                <h4>Muhammad Nur Ariyadi</h4>
                                <p>Programming, Report Maker, Assistant Project Manager</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="team-member">
                                <div class="team-img-container">
                                    <img src="{{ asset('image/img3.jpg') }}" class="img-fluid" alt="Team Member 3">
                                </div>
                                <h4>Windah Hariyati</h4>
                                <p>BMC, User Persona, Use case</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="team-member">
                                <div class="team-img-container">
                                    <img src="{{ asset('image/img4.jpg') }}" class="img-fluid" alt="Team Member 4">
                                </div>
                                <h4>Aini Dwi Amalia</h4>
                                <p>Design Database, Activity Diagram, User Persona</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header bg-info text-white text-center">
                    <h2>Project-Based Learning: Room Booking Information System</h2>
                </div>
                <div class="card-body">
                    <p class="text-justify">Our project is part of a Project-Based Learning (PBL) initiative where we are tasked with creating a comprehensive Room Booking Information System. The system aims to streamline the process of booking rooms, making it easier for users to check availability, book, and manage room reservations.</p>
                    <p class="text-justify">Throughout this project, our team has focused on the following key aspects:</p>
                    <ul>
                        <li>Developing a user-friendly interface for seamless room booking experiences.</li>
                        <li>Implementing robust back-end functionalities to manage bookings and room availability.</li>
                        <li>Ensuring data security and privacy for all users.</li>
                        <li>Creating detailed documentation to support future enhancements and maintenance.</li>
                    </ul>
                    <p class="text-justify">We are excited to present this system and believe it will significantly improve room management and booking efficiency. Thank you for taking the time to learn about our project!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
