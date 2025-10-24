const upcomingEvents = [
    {
        title: "Webinars and Workshops",
        date: "September 10, 2024",
        time: "3:00 PM - 5:00 PM",
        description: "Career Pathways for 11-12th Graders,College Admission Process Guidance,Study Abroad 101: Information sessions on selecting the right country and university, scholarship opportunities, and visa processes.",
        link:"https://example.com"
    },
    {
        title: "Career fairs",
        date: "September 20, 2024",
        time: "1:00 PM - 4:00 PM",
        description: "Virtual Career Fair: Invite representatives from different industries and educational institutions to interact with students, answer questions, and provide insights into various career paths.",
        link: "https://example.com"
    },
    {
        title: "Entrance Exam Preparation",
        date: "October 5-7, 2024",
        time: "Starts at 9:00 AM on August 5",
       
        description: "Exam Strategy Sessions: Guidance on preparing for entrance exams like SAT, ACT, GRE, GMAT, and country-specific exams.",
        link: "https://example.com"
    },
    
];


// Function to load events
function loadEvents() {
    const upcomingEventsContent = document.getElementById('upcoming-events-content');
    upcomingEvents.forEach(event => {
        upcomingEventsContent.innerHTML += `
            <div class="event">
                <h3>${event.title}</h3>
                <p><strong>Date:</strong> ${event.date}</p>
                <p><strong>Time:</strong> ${event.time}</p>
                <p>${event.description}</p>
                <a href="${event.link}">Register Here</a>
            </div>
        `;
    });

}

// Load events after DOM content is fully loaded
document.addEventListener('DOMContentLoaded', loadEvents);