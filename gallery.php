<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="lang.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
   <header>
    <nav class="main-nav">
      <ul>
        <li><a href="home.php" id="nav-home">الرئيسية</a></li>
        <li><a href="services.php" id="nav-services">خدمات</a></li>
        <li><a href="help.php" id="nav-help">مساعدة</a></li>
        <li><a href="blog.php" id="nav-blog">مدونة</a></li>
        <li><a href="about.php" id="nav-about">من نحن</a></li>
      </ul>
      <div class="lang-switch">
        <a href="#" onclick="setLang('ar'); return false;" id="ar-btn">العربية</a>
        <span> | </span>
        <a href="#" onclick="setLang('en'); return false;" id="en-btn">ENG</a>
      </div>
      <?php if (isset($_SESSION['user_id'])): ?>
        <span style="color:white; margin-left:15px;" id="welcome-msg">مرحباً،</span> <span style="color:white; margin-left:5px;" id="user-name"><?php echo htmlspecialchars($_SESSION['user_name'] ?? $_SESSION['user']); ?></span>
        <a href="logout.php" class="logout-btn" id="logout-btn">تسجيل الخروج</a>
      <?php else: ?>
        <a href="login.php" class="login-btn" id="nav-login">تسجيل دخول</a>
        <a href="register.php" class="register-btn" id="nav-register">تسجيل</a>
      <?php endif; ?>
    </nav>
  </header>

  <section class="hero">
  <h1 id="gallery-title">المناطق السياحية في السودان</h1>
  <p id="gallery-desc">تعرف على أجمل أربع مناطق سياحية مع الصور والفيديوهات.</p>
</section>
  <!-- معرض الصور والفيديوهات -->
<!-- معرض صور وفيديوهات ثابت -->
<section class="gallery">
  <div class="gallery-item">
    <img src="images/p1.jpeg" alt="صورة 1" class="gallery-media">
    <img src="images/p2.jpeg" alt="صورة 2" class="gallery-media">
    <img src="images/p3.jpeg" alt="صورة 3" class="gallery-media">
    <video src="images/PVideo.mp4" controls class="gallery-media"></video>
  </div>
  <section class="long-text">
  <h2 id="port-title">السياحة في بورتسودان</h2>
  <p id="port-desc">تُعد مدينة بورتسودان من أهم الوجهات السياحية في السودان، حيث تمتاز بجمال طبيعي فريد يجمع بين البحر والجبال والصحراء. تقع على ساحل البحر الأحمر، وتتميز بشواطئها البيضاء النقية ومياهها الصافية التي تجذب عشاق السباحة والغوص من داخل وخارج السودان. وتُعد الشعاب المرجانية في بورتسودان من أجمل وأندر الشعاب في العالم، ما يجعلها وجهة مميزة لهواة الغوص والاستكشاف البحري. كما توجد جزر سياحية قريبة مثل جزيرة سواكن وجزيرة عُقرة، التي تُعد أماكن مثالية للرحلات البحرية.
إلى جانب ذلك، توفر المدينة تجربة ثقافية ممتعة من خلال الأسواق الشعبية والمأكولات البحرية الطازجة والأجواء المحلية الدافئة، مما يجعلها وجهة سياحية متكاملة تجمع بين الراحة والمغامره.</p>
</section>
   <div class="gallery-item">
    <img src="images/d1.jpeg" alt="صورة 1" class="gallery-media">
    <img src="images/d2.jpeg" alt="صورة 2" class="gallery-media">
    <img src="images/d3.jpeg" alt="صورة 3" class="gallery-media">
    <img src="images/d4.jpeg" alt="صورة 3" class="gallery-media">
    <img src="images/d5.jpeg" alt="صورة 3" class="gallery-media">
  
  </div>
 <section class="long-text">
  <h2 id="dinder-title">محمية الدندر القومية</h2>
  <p id="dinder-desc">تُعد واحدة من أبرز الكنوز البيئية في السودان وإفريقيا، لما تتميز به من تنوع بيولوجي فريد وموقع جغرافي مميز.

---

📍 الموقع والمساحة

تقع محمية الدندر في جنوب شرق السودان، على الحدود مع إثيوبيا، وتبعد حوالي 400 كيلومتر عن العاصمة الخرطوم. تمتد المحمية عبر ثلاث ولايات: سنار، النيل الأزرق، والقضارف، وتبلغ مساحتها حوالي 10,292 كيلومتر مربع. تتخللها أنهار موسمية مثل نهري الرهد والدندر، بالإضافة إلى خيران وبرك مائية تُعرف بـ"الميعات"، التي تحتفظ بالمياه خلال فترات الجفاف، مما يجعلها بيئة مثالية لتكاثر الحياة البرية. [1]

---

🌿 التنوع البيئي والحيوي

النباتات

تضم المحمية ثلاث بيئات نباتية رئيسية:

- سافانا الغابات: تنتشر فيها أشجار الطلح والهجليج، وتغطي أكبر مساحة من المحمية.

- البيئات النهرية: تقع على ضفاف الأنهار والمجاري المائية، وتحتوي على أشجار الدوم والسنط والجميز.

- بيئة الميعات: تتميز بغطاء نباتي من الحشائش المعمرة والنباتات الحولية مثل نبات العدار.

تم تسجيل حوالي 58 نوعًا من الأشجار والشجيرات في المحمية. [2]

الحيوانات

تُعد المحمية موطنًا لأكثر من 40 نوعًا من الثدييات، منها:

- الأسود

- الجاموس

- التيتل

- الغزلان

- الضباع

- القردة

كما تم تسجيل أكثر من 260 نوعًا من الطيور، بما في ذلك الطيور المهاجرة مثل البجع الأبيض واللقلق، بالإضافة إلى دجاج الوادي الذي يُقدر عدده بالملايين. 

محمية الدندر القومية تُعد من أبرز المحميات الطبيعية في إفريقيا، لما تحتويه من تنوع بيولوجي فريد وأهمية بيئية كبيرة. إلا أنها تواجه تحديات كبيرة تتطلب تضافر الجهود الرسمية والشعبية للحفاظ عليها للأجيال القادمه</p>
</section>
</p>
   <div class="gallery-item">
    <img src="images/j1.jpeg" alt="صورة 1" class="gallery-media">
    <img src="images/j2.jpeg" alt="صورة 2" class="gallery-media">
    <img src="images/j3.jpeg" alt="صورة 3" class="gallery-media">
  
  </div>
  <section class="long-text">
  <h2 id="jabl-title">جمال وروعة جبل مرة – جنة السودان المخفية</h2>
  <p id="jabl-desc">يقع جبل مرة في غرب السودان، وهو واحد من أجمل الوجهات الطبيعية في البلاد. يتميز هذا الجبل بمناخه المعتدل على مدار العام، حيث تتساقط الأمطار بغزارة، مما يجعله واحة خضراء وسط الطبيعة الجافة المحيطة به.

تتزين المنطقة بالشلالات العذبة، والوديان الساحرة، والغابات الكثيفة التي تحتضن تنوعًا مذهلاً من الحياة البرية. كما يشتهر جبل مرة بإنتاج الفواكه الطازجة مثل البرتقال، المانجو، الرمان، والتفاح الأفريقي، والتي تنمو في تربته الخصبة.

إذا كنت تبحث عن مكان يجمع بين الجمال الطبيعي، والهدوء، والمغامرة، فإن جبل مرة هو الوجهة المثالية لاستكشاف روائع السودان الطبيعية!

---

The Beauty and Majesty of Jebel Marra – Sudan’s Hidden Paradise

Jebel Marra, located in western Sudan, is one of the country’s most breathtaking natural wonders. This stunning mountain boasts a mild climate throughout the year, with abundant rainfall that transforms it into a lush green oasis amidst the surrounding arid landscape.

The region is adorned with pristine waterfalls, mesmerizing valleys, and dense forests that host a diverse range of wildlife. Jebel Marra is also famous for its fresh fruits, including oranges, mangoes, pomegranates, and African apples, which thrive in its fertile soil.

If you're looking for a destination that combines natural beauty, serenity, and adventure, Jebel Marra is the perfect place to explore Sudan’s hidden treasures!

  
  </p>
</section>
 <div class="gallery-item">
    <img src="images/m5.jpeg" alt="صورة 1" class="gallery-media">
    <img src="images/m2.jpeg" alt="صورة 2" class="gallery-media">
    <img src="images/m3.jpeg" al="صورة 3" class="gallery-media">
    <video src="images/m4.mp4" controls class="gallery-media"></video>
  
  </div>
  <section class="long-text">
  <h2 id="meroe-title">مدينة مروي (أو البجراوية) في شمال السودان </h2>
  <p id="meroe-desc">تُعد من أبرز الوجهات السياحية في البلاد، خاصة لعشاق التاريخ والحضارات القديمة. إليك أهم الأماكن السياحية فيها:

1. أهرامات البجراوية (أهرامات مروي)

تقع في منطقة البجراوية وتضم أكثر من 200 هرم صغير نسبيًا.

تعود إلى مملكة مروي (حوالي 300 ق.م - 350 م)، إحدى أعظم حضارات النوبة.

تتميز بتصميمها الفريد وأهميتها الأثرية والتاريخية.
2. مدينة مروي الملكية القديمة
تقع بالقرب من الأهرامات وتشمل بقايا القصور والمعابد.

من أبرز المعالم: معبد الإله آمون، والمقابر الملكية.
3. معبد الأسد – نقش الأسد
معبد مخصص للإله أبيدماك (إله الحرب عند المرويين)، ويُعرف بتمثال الأسد الشهير المنحوت من الحجر الرملي.

4. نهر النيل – ضفاف النهر

توفر مناظر طبيعية خلابة، خاصة عند الغروب.

يمكن القيام بجولات نهرية أو التخييم على ضفاف النهر.

5. جبال البركل (قريبة من مروي)

رغم أنها تقع جنوب مروي قليلاً (في كريمة)، لكنها جزء من المنطقة التاريخية.

تحتوي على معابد ومقابر ملكية وتُعد من مواقع التراث العالمي لليونسكو.</p>
  </p>
</section>