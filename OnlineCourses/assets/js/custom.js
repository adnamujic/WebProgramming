$(document).ready(function() {

    var app = $.spapp({
      defaultView  : "#home",
      templateDir  : "./pages/",
      pageNotFound : "error_404"
    });

    app.route({
      view : "home",
      load : "home.html",
    });

    app.route({
      view : "about",
      load : "about.html",
    });
    
    app.route({
      view : "blog",
      load : "blog.html",
    });

    app.route({
      view : "projectBlog",
      load : "projectBlog.html",
    });


    app.route({
      view : "faq",
      load : "faq.html",
    });

    app.route({
      view : "practiceZone",
      load : "practiceZone.html",
    });

    app.route({
      view : "task",
      load : "task.html",
    });



    app.route({
      view : "allCourses",
      load : "allCourses.html",
    });

    app.route({
      view : "reviews",
      load : "reviews.html",
    });

    app.route({
      view : "registration",
      load : "registration.html",
    });

    app.route({
      view : "dashboard",
      load : "dashboard.html",
    });

    app.route({
      view : "enrollments",
      load : "enrollments.html",
    });

    // run app
    app.run();
  
  });