/**
 * INTECARE EXCELLENCE AWARD 2026 — OFFICIAL ASSISTANT KNOWLEDGE BASE
 * 
 * PRIMARY SOURCE OF TRUTH: Intecare 2026 Web Content Draft_2.pdf
 * This structured dataset powers the local mock assistant without external AI APIs or hallucination.
 * STRICT POLICY: ZERO EMOJIS anywhere in the code, data, responses, or UI.
 */

(function () {
  'use strict';

  const knowledge = {
    meta: {
      assistantName: "INTECARE Assistant",
      tagline: "Official Award Information",
      sourceDoc: "Intecare 2026 Web Content Draft_2.pdf",
      introMessage: "Hello. I'm the INTECARE Assistant.\n\nI can help you find information about the INTECARE Excellence Award 2026, including award categories, eligibility, nomination requirements, guidelines and event details."
    },

    quickQuestions: [
      { id: "who_can_nominate", text: "Who can be nominated?" },
      { id: "all_categories", text: "What are the 40 award categories?" },
      { id: "nomination_requirements", text: "What are the nomination requirements?" },
      { id: "evaluation_criteria", text: "What are the evaluation criteria?" },
      { id: "how_to_nominate", text: "How do I submit a nomination?" },
      { id: "event_gala_details", text: "When & where is the gala?" },
      { id: "organisers_hwed_miha", text: "Tell me about HWED and MIHA." },
      { id: "why_nominate", text: "Why nominate for INTECARE 2026?" }
    ],

    // Comprehensive 40 Award Categories (Official Booklet Pages 15–16)
    awardCategories: {
      individual: {
        total: 20,
        packageFee: "RM 20,000",
        pillars: [
          {
            name: "STAY WELL",
            focus: "Prevention, Wellness & Health Promotion",
            description: "Individuals who advance prevention, health promotion, wellness, healthy lifestyles, community wellbeing and holistic approaches to maintaining health.",
            awards: [
              "INTECARE Preventive Health Leadership Award 2026",
              "INTECARE Community Health Leadership Award 2026",
              "INTECARE Wellness & Lifestyle Medicine Leadership Award 2026",
              "INTECARE Mental Wellbeing Advocacy Award 2026",
              "INTECARE Health Promotion Innovation Award 2026"
            ]
          },
          {
            name: "GET WELL",
            focus: "Healthcare, Care & Patient Outcomes",
            description: "Individuals who advance professional healthcare practice, integrated and patient-centred care, accessible and innovative healthcare delivery and improved patient outcomes.",
            awards: [
              "INTECARE Integrative Healthcare Professional Leadership Award 2026",
              "INTECARE Patient-Centred Care Leadership Award 2026",
              "INTECARE Evidence-Based Medicine Leadership Award 2026",
              "INTECARE Healthcare Innovation in Care Delivery Award 2026",
              "INTECARE Clinical Excellence Leadership Award 2026"
            ]
          },
          {
            name: "RECOVER WELL",
            focus: "Rehabilitation, Recovery & Independence",
            description: "Individuals who contribute to rehabilitation, recovery, mental wellness, functional independence and improved quality of life.",
            awards: [
              "INTECARE Rehabilitation Leadership Award 2026",
              "INTECARE Recovery & Functional Healthcare Leadership Award 2026",
              "INTECARE Integrated Recovery Care Leadership Award 2026",
              "INTECARE Mental Health Recovery Leadership Award 2026",
              "INTECARE Independent Living & Social Care Leadership Award 2026"
            ]
          },
          {
            name: "AGE WELL",
            focus: "Healthy Ageing, Longevity & Active Living",
            description: "Individuals advancing healthy ageing, longevity, active ageing, independence and quality of life across the ageing population.",
            awards: [
              "INTECARE Healthy Ageing Advocacy Award 2026",
              "INTECARE Active Ageing Leadership Award 2026",
              "INTECARE Longevity & Lifestyle Innovation Award 2026",
              "INTECARE Age-Friendly Healthcare Leadership Award 2026",
              "INTECARE Excellence in Ageing & Quality of Life Leadership Award 2026"
            ]
          }
        ]
      },
      corporate: {
        total: 20,
        packageFee: "RM 30,000",
        pillars: [
          {
            name: "01 ORGANISATIONAL EXCELLENCE",
            focus: "Organisational Leadership & Impact",
            description: "Organisations demonstrating outstanding leadership, excellence and impactful contributions to the healthcare and wellness economy.",
            awards: [
              "INTECARE Healthcare Organisation Excellence Award 2026",
              "INTECARE Wellness Organisation Excellence Award 2026",
              "INTECARE Healthcare Brand Excellence Award 2026",
              "INTECARE Emerging Healthcare Enterprise Excellence Award 2026",
              "INTECARE Excellence in Healthcare Impact Award 2026"
            ]
          },
          {
            name: "02 INNOVATION & TRANSFORMATION",
            focus: "Technology & Integrated Solutions",
            description: "Organisations driving innovation, digital transformation and technology to advance integrated healthcare and wellness.",
            awards: [
              "INTECARE Healthcare Innovation Excellence Award 2026",
              "INTECARE Digital Health Transformation Excellence Award 2026",
              "INTECARE Health Technology Excellence Award 2026",
              "INTECARE Integrative Healthcare Innovation Excellence Award 2026",
              "INTECARE Future of Healthcare Excellence Award 2026"
            ]
          },
          {
            name: "03 PEOPLE, WORKPLACE & COMMUNITY",
            focus: "Culture, Workforce & Social Impact",
            description: "Organisations empowering people, building a positive workplace culture and creating meaningful impact in communities.",
            awards: [
              "INTECARE Employer of Choice – Healthcare & Wellness Excellence Award 2026",
              "INTECARE Healthcare Workforce Development Excellence Award 2026",
              "INTECARE Excellence in Employee Wellbeing Award 2026",
              "INTECARE Community Partnership Excellence Award 2026",
              "INTECARE Social Impact & Community Development Excellence Award 2026"
            ]
          },
          {
            name: "04 INDUSTRY, SUSTAINABILITY & ECOSYSTEM",
            focus: "Partnerships & Long-term Development",
            description: "Organisations advancing a sustainable, inclusive and resilient healthcare and wellness ecosystem through strategic partnerships, enterprise development and economic contribution.",
            awards: [
              "INTECARE Sustainable Healthcare Excellence Award 2026",
              "INTECARE Healthcare Ecosystem Partnership Excellence Award 2026",
              "INTECARE Excellence in Healthcare Enterprise Development Award 2026",
              "INTECARE Healthcare Investment & Growth Excellence Award 2026",
              "INTECARE Outstanding Contribution to the Healthcare & Wellness Economy Award 2026"
            ]
          }
        ]
      }
    },

    // Topics mapped directly to the official PDF
    topics: [
      {
        id: "about_intecare",
        patterns: [
          /\babout intecare\b/i,
          /\bwhat is intecare\b/i,
          /\bpurpose\b/i,
          /\bvision\b/i,
          /\bmission\b/i,
          /\boverview\b/i,
          /\bbackground\b/i
        ],
        keywords: ["about", "intecare", "purpose", "mission", "vision", "overview"],
        buildResponse: function () {
          return {
            content: `
<p><strong>INTECARE EXCELLENCE AWARD 2026</strong> brings together healthcare, wellness, education, professional practice, innovation, technology, enterprise and industry into one distinguished national platform.</p>
<p>Organised through the strategic collaboration between <strong>Healthcare &amp; Wellness Economy Development (HWED)</strong> and <strong>Malaysian Integrative Health Association (MIHA)</strong>, it celebrates excellence across the complete human health lifecycle.</p>
<p><strong>Common Direction:</strong> Healthier People | Better Care | Stronger Economy</p>
<p><strong>Official Event Highlights:</strong></p>
<ul>
  <li>Official Launch of HWED</li>
  <li>Presentation of 40 Excellence Awards (20 Individual &amp; 20 Corporate)</li>
  <li>Olympia Education Convocation celebrating 45 graduates</li>
  <li>Launch and showcase of a Nanotech Sanitizer product innovation</li>
</ul>
            `.trim(),
            actions: [
              { label: "Explore 40 Awards", action: "explore_awards" },
              { label: "View Award Guidelines", action: "view_guidelines" },
              { label: "Submit Nomination", action: "submit_nomination", primary: true }
            ]
          };
        }
      },

      {
        id: "who_can_nominate",
        patterns: [
          /who.*(nominated|nominate|eligible|apply|qualif)/i,
          /eligible.*(who|people|candidate|company)/i,
          /individual.*corporate/i
        ],
        keywords: ["who", "nominate", "nominated", "eligible", "individuals", "corporate", "organisations"],
        buildResponse: function () {
          return {
            content: `
<p>The INTECARE 2026 Excellence Awards accept nominations across two primary sectors:</p>
<p><strong>1. Individuals:</strong></p>
<ul>
  <li>Healthcare Professionals &amp; Wellness Professionals</li>
  <li>Healthcare Leaders &amp; Community Health Leaders</li>
  <li>Educators &amp; Researchers</li>
  <li>Entrepreneurs &amp; Innovators</li>
  <li>Care Professionals, Technology Professionals &amp; Industry Practitioners</li>
</ul>
<p><strong>2. Corporate / Organisations:</strong></p>
<ul>
  <li>Healthcare Providers &amp; Wellness Organisations</li>
  <li>Healthcare SMEs &amp; Wellness Brands</li>
  <li>Start-ups &amp; Corporations</li>
  <li>Education &amp; Knowledge Institutions</li>
  <li>Technology Companies &amp; Care Economy Providers</li>
  <li>NGOs, Social Enterprises &amp; Industry Organisations</li>
  <li>Government &amp; Public-Sector Organisations</li>
</ul>
<p><em>Open to organisations, institutions, professionals and individuals within Malaysia and internationally. Achievements must be within the last 3 years.</em></p>
            `.trim(),
            actions: [
              { label: "Explore 40 Awards", action: "explore_awards" },
              { label: "Submit Nomination", action: "submit_nomination", primary: true }
            ]
          };
        }
      },

      {
        id: "all_categories",
        patterns: [
          /\b40\b.*award/i,
          /award.*categor/i,
          /what.*award/i,
          /which.*award/i,
          /list.*award/i,
          /what.*awards.*available/i,
          /individual.*award/i,
          /corporate.*award/i
        ],
        keywords: ["40", "awards", "categories", "individual", "corporate", "list"],
        buildResponse: function () {
          return {
            content: `
<p>The official programme features <strong>40 Excellence Awards</strong>, presented in two segments:</p>
<p><strong>20 Individual Excellence Awards:</strong></p>
<ul>
  <li><strong>Stay Well:</strong> Preventive Health, Community Health, Wellness &amp; Lifestyle Medicine, Mental Wellbeing Advocacy, Health Promotion Innovation.</li>
  <li><strong>Get Well:</strong> Integrative Healthcare Professional, Patient-Centred Care, Evidence-Based Medicine, Healthcare Innovation in Care Delivery, Clinical Excellence.</li>
  <li><strong>Recover Well:</strong> Rehabilitation, Recovery &amp; Functional Healthcare, Integrated Recovery Care, Mental Health Recovery, Independent Living &amp; Social Care.</li>
  <li><strong>Age Well:</strong> Healthy Ageing Advocacy, Active Ageing, Longevity &amp; Lifestyle Innovation, Age-Friendly Healthcare, Excellence in Ageing &amp; Quality of Life.</li>
</ul>
<p><strong>20 Corporate Excellence Awards:</strong></p>
<ul>
  <li><strong>01 Organisational Excellence:</strong> Healthcare Organisation, Wellness Organisation, Healthcare Brand, Emerging Healthcare Enterprise, Excellence in Healthcare Impact.</li>
  <li><strong>02 Innovation &amp; Transformation:</strong> Healthcare Innovation, Digital Health Transformation, Health Technology, Integrative Healthcare Innovation, Future of Healthcare.</li>
  <li><strong>03 People, Workplace &amp; Community:</strong> Employer of Choice – Healthcare &amp; Wellness, Healthcare Workforce Development, Excellence in Employee Wellbeing, Community Partnership, Social Impact &amp; Community Development.</li>
  <li><strong>04 Industry, Sustainability &amp; Ecosystem:</strong> Sustainable Healthcare, Healthcare Ecosystem Partnership, Excellence in Healthcare Enterprise Development, Healthcare Investment &amp; Growth, Outstanding Contribution to the Healthcare &amp; Wellness Economy.</li>
</ul>
            `.trim(),
            actions: [
              { label: "Explore 40 Awards", action: "explore_awards" },
              { label: "Submit Nomination", action: "submit_nomination", primary: true }
            ]
          };
        }
      },

      {
        id: "nomination_requirements",
        patterns: [
          /nomination.*requirement/i,
          /what.*document/i,
          /supporting.*document/i,
          /page.*limit/i,
          /how.*many.*page/i,
          /what.*language/i,
          /english.*malay/i
        ],
        keywords: ["nomination", "requirements", "supporting", "documents", "pages", "language"],
        buildResponse: function () {
          return {
            content: `
<p>Nomination requirements include a completed nomination form and supporting documents such as a project summary, evidence of impact, photographs, press coverage or testimonials. A maximum of 10 supporting pages is stated, and submissions may be made in English or Malay.</p>
<p><strong>Documented Guidelines Checklist:</strong></p>
<ul>
  <li><strong>Completed Nomination Form:</strong> Contact details, title, organisation, and nomination statement.</li>
  <li><strong>Supporting Materials:</strong> Project summary, evidence of impact, photographs, press coverage, testimonials.</li>
  <li><strong>Page Cap:</strong> Maximum of <strong>10 supporting pages</strong>.</li>
  <li><strong>Accepted Languages:</strong> English or Malay.</li>
  <li><strong>Eligibility Window:</strong> Relevant achievements within the last 3 years.</li>
</ul>
            `.trim(),
            actions: [
              { label: "View Award Guidelines", action: "view_guidelines" },
              { label: "Submit Nomination", action: "submit_nomination", primary: true }
            ]
          };
        }
      },

      {
        id: "judges_names",
        patterns: [
          /who.*(are|names).*judges/i,
          /judges.*name/i,
          /who.*evaluat.*panel/i,
          /names.*evaluat/i
        ],
        keywords: ["judges", "names", "who are the judges"],
        buildResponse: function () {
          return {
            content: `
<p>I do not have the names of the evaluation panel in the official information available to me.</p>
<p>The official guidelines state that:</p>
<ul>
  <li>All nominations will be reviewed by a panel of independent experts.</li>
  <li>Shortlisted nominees may be invited to provide additional information or attend an interview (if required).</li>
  <li>The Organising Committee's decision is final.</li>
</ul>
            `.trim(),
            actions: [
              { label: "View Award Guidelines", action: "view_guidelines" },
              { label: "Submit Nomination", action: "submit_nomination" }
            ]
          };
        }
      },

      {
        id: "evaluation_criteria",
        patterns: [
          /evaluat.*criteria/i,
          /selection.*process/i,
          /how.*assess/i,
          /how.*evaluat/i,
          /judg.*criteria/i,
          /scoring/i
        ],
        keywords: ["evaluation", "criteria", "selection", "process", "assessment", "panel"],
        buildResponse: function () {
          return {
            content: `
<p><strong>Evaluation Criteria:</strong><br>Nominations will be assessed based on five official pillars:</p>
<ol>
  <li><strong>Relevance to HWED pillars and objectives</strong></li>
  <li><strong>Impact and measurable outcomes</strong></li>
  <li><strong>Innovation and best practices</strong></li>
  <li><strong>Sustainability and scalability</strong></li>
  <li><strong>Leadership and collaboration</strong></li>
</ol>
<p><strong>Selection Process:</strong></p>
<ul>
  <li>All nominations will be reviewed by a panel of independent experts.</li>
  <li>Shortlisted nominees may be invited to provide additional information or attend an interview (if required).</li>
  <li>The Organising Committee's decision is final.</li>
</ul>
            `.trim(),
            actions: [
              { label: "View Award Guidelines", action: "view_guidelines" },
              { label: "Submit Nomination", action: "submit_nomination", primary: true }
            ]
          };
        }
      },

      {
        id: "how_to_nominate",
        patterns: [
          /how.*(nominate|submit)/i,
          /submit.*nomination/i,
          /nomination.*process/i,
          /nomination.*journey/i,
          /how.*apply/i,
          /steps.*nominate/i
        ],
        keywords: ["how", "submit", "nominate", "nomination", "steps", "journey"],
        buildResponse: function () {
          return {
            content: `
<p>The documented official nomination journey follows a 5-step website flow:</p>
<p><strong>AWARD GUIDELINES → SUBMIT YOUR NOMINATION → NOMINATION FORM → REVIEW &amp; SUBMIT → SUBMISSION CONFIRMATION</strong></p>
<p><strong>Submission Steps:</strong></p>
<ul>
  <li><strong>Step 1: Nominee Type:</strong> Select Individual or Corporate / Organisation.</li>
  <li><strong>Step 2: Nominee Information:</strong> Contact details, title, organisation, and industry sector.</li>
  <li><strong>Step 3: Award Category:</strong> Choose from the 20 Individual or 20 Corporate categories.</li>
  <li><strong>Step 4: Nomination Statement:</strong> Provide key achievement, impact created, and healthcare &amp; wellness contribution.</li>
  <li><strong>Step 5: Supporting Documents &amp; Declaration:</strong> Upload up to 10 supporting pages in English or Malay and confirm the declaration.</li>
</ul>
            `.trim(),
            actions: [
              { label: "Submit Nomination", action: "submit_nomination", primary: true },
              { label: "Track Nomination Status", action: "track_status" }
            ]
          };
        }
      },

      {
        id: "self_nomination",
        patterns: [
          /can.*nominate.*myself/i,
          /self.*nomination/i,
          /nominate.*someone.*else/i,
          /third.*party/i,
          /nomination.*source/i
        ],
        keywords: ["self", "myself", "third-party", "source"],
        buildResponse: function () {
          return {
            content: `
<p><strong>Yes, self-nominations are fully welcomed and accepted.</strong></p>
<p>The official guidelines state that submissions may be made as:</p>
<ul>
  <li><strong>Self-Nomination:</strong> Individuals or organisations submitting directly on behalf of their own achievements.</li>
  <li><strong>Third-Party Nomination:</strong> Colleagues, partner institutions, or industry stakeholders nominating deserving professionals or organisations.</li>
</ul>
<p>In both cases, relevant achievements must have taken place within the <strong>last 3 years</strong>.</p>
            `.trim(),
            actions: [
              { label: "Submit Nomination", action: "submit_nomination", primary: true },
              { label: "Explore 40 Awards", action: "explore_awards" }
            ]
          };
        }
      },

      {
        id: "important_dates",
        patterns: [
          /\bwhen is the nomination\b/i,
          /\bnomination opening\b/i,
          /\bdeadline\b/i,
          /\btimeline\b/i,
          /\b28 september\b/i
        ],
        keywords: ["date", "dates", "deadline", "timeline", "milestones", "schedule", "opening"],
        buildResponse: function () {
          return {
            content: `
<p>The official milestones documented for INTECARE 2026 are:</p>
<ul>
  <li><strong>Nomination Opening:</strong> 28 September 2026</li>
  <li><strong>Awards Presentation &amp; Gala Dinner:</strong> 27 November 2026 (Friday)</li>
</ul>
<p><em>Note: No additional deadlines are specified in the official draft. Prospective nominees are advised to finalize and submit their dossiers early.</em></p>
            `.trim(),
            actions: [
              { label: "Submit Nomination", action: "submit_nomination", primary: true },
              { label: "Event Details", action: "event_details" }
            ]
          };
        }
      },

      {
        id: "event_gala_details",
        patterns: [
          /\bwhere\b/i,
          /\bvenue\b/i,
          /\bhotel royale chulan\b/i,
          /\bgala\b/i,
          /\bdinner\b/i,
          /\bwhen.*(gala|event|dinner)/i,
          /\bevent.*(details|info|where|when)/i,
          /\blocation\b/i,
          /\btime\b.*(gala|event|start)/i
        ],
        keywords: ["where", "venue", "gala", "dinner", "event", "location", "damansara", "when is the gala"],
        buildResponse: function () {
          return {
            content: `
<p><strong>INTECARE EXCELLENCE AWARD 2026 GALA DINNER</strong></p>
<ul>
  <li><strong>Date:</strong> 27 November 2026 (Friday)</li>
  <li><strong>Time:</strong> 7:30 PM – 11:00 PM</li>
  <li><strong>Venue:</strong> Hotel Royale Chulan Damansara, 47810 Petaling Jaya, Selangor, Malaysia.</li>
</ul>
<p><strong>The Evening Experience Features:</strong></p>
<ul>
  <li><strong>Red Carpet:</strong> Distinguished arrival for VVIPs, guests, nominees, graduates and partners.</li>
  <li><strong>Formal Dinner:</strong> Bringing together healthcare and wellness leaders.</li>
  <li><strong>Official HWED Launch:</strong> The formal introduction of the Healthcare &amp; Wellness Economy Development ecosystem.</li>
  <li><strong>Excellence Awards:</strong> Formal presentation of 40 individual and corporate achievements.</li>
  <li><strong>Convocation:</strong> Celebration of 45 Olympia Education graduates.</li>
  <li><strong>Product Innovation:</strong> Launch and showcase of a Nanotech Sanitizer.</li>
  <li><strong>Networking:</strong> Strategic connection across healthcare, wellness, education, technology, enterprise and industry.</li>
</ul>
            `.trim(),
            actions: [
              { label: "Event Details", action: "event_details" },
              { label: "Submit Nomination", action: "submit_nomination", primary: true }
            ]
          };
        }
      },

      {
        id: "organisers_hwed_miha",
        patterns: [
          /\bhwed\b/i,
          /\bmiha\b/i,
          /\bolympia\b/i,
          /\borganiser/i,
          /\balliance\b/i,
          /\bpartner\b/i
        ],
        keywords: ["hwed", "miha", "olympia", "organisers", "alliance", "partners"],
        buildResponse: function () {
          return {
            content: `
<p>INTECARE 2026 is organised through the strategic collaboration of distinguished national entities:</p>
<p><strong>Healthcare &amp; Wellness Economy Development (HWED) — Ecosystem Enabler:</strong><br>An integrated platform connecting science, professional practice, technology, enterprise, investment and industry across the complete human health lifecycle (Stay Well, Get Well, Recover Well, Age Well). Its mission is to build a unified economy rather than a collection of separate industries.</p>
<p><strong>Malaysian Integrative Health Association (MIHA) — National Integrative Authority:</strong><br>A national platform uniting healthcare professionals across disciplines to advance integrative health, holistic care, evidence-based practice and innovation in Malaysia.</p>
<p><strong>Olympia Education Group — Academic Convocation Partner:</strong><br>Honouring 45 academic graduates in healthcare and wellness during the gala evening.</p>
            `.trim(),
            actions: [
              { label: "Explore 40 Awards", action: "explore_awards" },
              { label: "View Award Guidelines", action: "view_guidelines" }
            ]
          };
        }
      },

      {
        id: "award_packages_fees",
        patterns: [
          /\bfee\b/i,
          /\bfees\b/i,
          /\bcost\b/i,
          /\bprice\b/i,
          /\bhow much\b/i,
          /\brm 20,000\b/i,
          /\brm 30,000\b/i,
          /\bpackage\b/i
        ],
        keywords: ["fee", "cost", "price", "package", "rm", "20,000", "30,000"],
        buildResponse: function () {
          return {
            content: `
<p>According to the official <strong>INTECARE 2026 Award Package</strong> documentation (Page 15):</p>
<p><strong>Individual Award Package — RM 20,000</strong></p>
<ul>
  <li>Official Award (a handcrafted crystal symbol of achievement and impact)</li>
  <li>Official Certificate of Recognition</li>
  <li>10 Seats at Dinner Ceremony (for you and your guests)</li>
  <li>Individual Recognition &amp; Visibility across selected event communications</li>
</ul>
<p><strong>Corporate Award Package — RM 30,000</strong></p>
<ul>
  <li>Official Award (a symbol of your organisation's commitment and impact)</li>
  <li>Official Certificate of Recognition</li>
  <li>10 Seats at Dinner Ceremony (for your organisation and guests)</li>
  <li>Corporate Recognition &amp; Visibility across selected event communications</li>
</ul>
            `.trim(),
            actions: [
              { label: "Explore 40 Awards", action: "explore_awards" },
              { label: "Submit Nomination", action: "submit_nomination", primary: true }
            ]
          };
        }
      },

      {
        id: "why_nominate",
        patterns: [
          /why.*nominate/i,
          /\bbenefits\b/i,
          /\bvalue\b/i,
          /\bwhy apply\b/i,
          /\brecognition\b/i
        ],
        keywords: ["why", "nominate", "benefits", "value", "recognition"],
        buildResponse: function () {
          return {
            content: `
<p>The official documentation outlines five strategic reasons to nominate:</p>
<ul>
  <li><strong>Recognition:</strong> Showcase your contribution to healthcare, wellness and the development of the healthcare and wellness economy.</li>
  <li><strong>Visibility:</strong> Put your organisation, initiative or leadership in the spotlight before healthcare, wellness, education and industry stakeholders.</li>
  <li><strong>Credibility:</strong> Demonstrate commitment to professional excellence, innovation, impact and responsible healthcare and wellness development.</li>
  <li><strong>Connections:</strong> Engage with healthcare, wellness, education, technology, enterprise, investment, government and industry leaders.</li>
  <li><strong>Ecosystem Opportunities:</strong> Create opportunities for collaboration, strategic partnerships, innovation, enterprise development and market expansion.</li>
</ul>
<p><strong>Official Pathway:</strong> Nominate → Assess → Recognise → Inspire</p>
            `.trim(),
            actions: [
              { label: "Submit Nomination", action: "submit_nomination", primary: true },
              { label: "View Award Guidelines", action: "view_guidelines" }
            ]
          };
        }
      },

      {
        id: "tracking_status",
        patterns: [
          /\btrack\b/i,
          /\bstatus\b/i,
          /\bdossier\b/i,
          /\bint26\b/i,
          /\breference\b/i,
          /\bprogress\b/i
        ],
        keywords: ["track", "status", "int26", "reference", "dossier"],
        buildResponse: function () {
          return {
            content: `
<p>You can securely verify the real-time progress of any submitted nomination dossier online:</p>
<ul>
  <li>Use your official tracking reference in format: <code>INT26-XXXXXXXX</code>.</li>
  <li>Enter the registered work email address used during dossier submission for two-factor verification.</li>
  <li>The portal displays current screening status: Under Initial Screening, Formal Committee Review, or Final Stage.</li>
</ul>
            `.trim(),
            actions: [
              { label: "Track Nomination Status", action: "track_status", primary: true },
              { label: "Submit Nomination", action: "submit_nomination" }
            ]
          };
        }
      }
    ],

    // Fallback response for unverified questions
    getFallbackResponse: function (userQuery) {
      return {
        content: `
<p>I do not have specific official information regarding that topic in the approved INTECARE 2026 documentation available to me.</p>
<p>As an official concierge, I only provide verified facts directly from the INTECARE 2026 draft.</p>
<p>For inquiries regarding this topic or custom secretariat assistance, please contact:</p>
<ul>
  <li><strong>General Secretariat:</strong> <a href="mailto:secretariat@intecare.org">secretariat@intecare.org</a></li>
  <li><strong>Nomination Dossier Desk:</strong> <a href="mailto:nominations@intecare.org">nominations@intecare.org</a></li>
</ul>
        `.trim(),
        actions: [
          { label: "View Award Guidelines", action: "view_guidelines" },
          { label: "Explore 40 Awards", action: "explore_awards" },
          { label: "Submit Nomination", action: "submit_nomination" }
        ]
      };
    },

    // Intelligent Search and Matching Engine
    matchQuery: function (query) {
      if (!query || typeof query !== 'string') {
        return this.getFallbackResponse();
      }

      const cleanQuery = query.toLowerCase().replace(/[^\w\s-]/g, ' ').replace(/\s+/g, ' ').trim();

      // 1. Direct ID match (from quick buttons)
      for (const topic of this.topics) {
        if (topic.id === query || topic.id === cleanQuery) {
          return topic.buildResponse();
        }
      }

      // 2. RegEx Pattern Matching (High Precision across primary topics)
      for (const topic of this.topics) {
        if (topic.patterns) {
          for (const pattern of topic.patterns) {
            if (pattern.test(query) || pattern.test(cleanQuery)) {
              return topic.buildResponse();
            }
          }
        }
      }

      // 3. Specific Award Category lookup
      for (const pillar of this.awardCategories.individual.pillars) {
        for (const award of pillar.awards) {
          const awardLower = award.toLowerCase();
          const simplifiedAward = awardLower.replace(/intecare\s*|2026/g, '').trim();
          if (
            (cleanQuery.length >= 8 && (simplifiedAward.includes(cleanQuery) || awardLower.includes(cleanQuery))) ||
            (cleanQuery.includes(simplifiedAward))
          ) {
            return {
              content: `
<p><strong>Official Award Category:</strong></p>
<p><strong>${award}</strong></p>
<p><strong>Segment:</strong> Individual Excellence Award</p>
<p><strong>Pillar:</strong> ${pillar.name} (${pillar.focus})</p>
<p><strong>Recognition Focus:</strong> ${pillar.description}</p>
              `.trim(),
              actions: [
                { label: "Submit Nomination", action: "submit_nomination", primary: true },
                { label: "Explore 40 Awards", action: "explore_awards" }
              ]
            };
          }
        }
      }

      for (const pillar of this.awardCategories.corporate.pillars) {
        for (const award of pillar.awards) {
          const awardLower = award.toLowerCase();
          const simplifiedAward = awardLower.replace(/intecare\s*|2026/g, '').trim();
          if (
            (cleanQuery.length >= 8 && (simplifiedAward.includes(cleanQuery) || awardLower.includes(cleanQuery))) ||
            (cleanQuery.includes(simplifiedAward))
          ) {
            return {
              content: `
<p><strong>Official Award Category:</strong></p>
<p><strong>${award}</strong></p>
<p><strong>Segment:</strong> Corporate Excellence Award</p>
<p><strong>Pillar:</strong> ${pillar.name} (${pillar.focus})</p>
<p><strong>Recognition Focus:</strong> ${pillar.description}</p>
              `.trim(),
              actions: [
                { label: "Submit Nomination", action: "submit_nomination", primary: true },
                { label: "Explore 40 Awards", action: "explore_awards" }
              ]
            };
          }
        }
      }

      // 4. Token & Keyword Overlap Scoring
      const queryWords = cleanQuery.split(' ').filter(w => w.length > 2);
      let bestTopic = null;
      let highestScore = 0;

      for (const topic of this.topics) {
        let score = 0;
        for (const kw of topic.keywords) {
          if (cleanQuery === kw) {
            score += 15;
          } else if (cleanQuery.includes(kw)) {
            score += kw.length;
          } else {
            for (const word of queryWords) {
              if (word === kw) score += 5;
            }
          }
        }

        if (score > highestScore) {
          highestScore = score;
          bestTopic = topic;
        }
      }

      if (bestTopic && highestScore >= 4) {
        return bestTopic.buildResponse();
      }

      // 5. Safe Fallback without hallucination
      return this.getFallbackResponse(query);
    }
  };

  // Expose knowledge base globally
  window.intecareAssistantKnowledge = knowledge;

})();
