PGDMP         %                {            postgres    15.2    15.2 v    N           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            O           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            P           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            Q           1262    5    postgres    DATABASE     ~   CREATE DATABASE postgres WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Colombia.1252';
    DROP DATABASE postgres;
                postgres    false            R           0    0    DATABASE postgres    COMMENT     N   COMMENT ON DATABASE postgres IS 'default administrative connection database';
                   postgres    false    3665                        2615    263304 
   simat_mass    SCHEMA        CREATE SCHEMA simat_mass;
    DROP SCHEMA simat_mass;
                postgres    false            P           1255    339779    audi_request_fun()    FUNCTION     �  CREATE FUNCTION simat_mass.audi_request_fun() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
declare
	BEGIN 
		IF(TG_OP='UPDATE') THEN
			INSERT INTO SIMAT_MASS.AUDI_REQUEST(consecutivo,id_req,id_curr_req,id_stud_req,
												state_req,registration_req,admission_req,observation_req,
											    register_date,action_audi)
			VALUES (DEFAULT, OLD.id_req,OLD.id_curr_req,OLD.id_stud_req,
	 						 OLD.state_req,OLD.registration_req,OLD.admission_req,OLD.observation_req,
							 current_timestamp(0),'U' );
			RETURN NEW;
			
		ELSIF(TG_OP='DELETE') THEN
			INSERT INTO SIMAT_MASS.AUDI_REQUEST(consecutivo,id_req,id_curr_req,id_stud_req,
												state_req,registration_req,admission_req,observation_req,
											    register_date,action_audi)
			VALUES (DEFAULT, OLD.id_req,OLD.id_curr_req,OLD.id_stud_req,
	 						 OLD.state_req,OLD.registration_req,OLD.admission_req,OLD.observation_req,
							 current_timestamp(0),'D' );
			RETURN OLD;
		END IF;
   END;
$$;
 -   DROP FUNCTION simat_mass.audi_request_fun();
    
   simat_mass          postgres    false    14            ;           1259    340490    audi_request    TABLE     �  CREATE TABLE simat_mass.audi_request (
    consecutivo integer NOT NULL,
    id_req integer NOT NULL,
    id_curr_req integer NOT NULL,
    id_stud_req integer NOT NULL,
    state_req character varying(1) DEFAULT 'C'::character varying,
    registration_req character varying(1) DEFAULT 'N'::character varying,
    admission_req character varying(1) DEFAULT 'N'::character varying,
    observation_req character varying(40) DEFAULT 'Sin Observación'::character varying,
    register_date timestamp without time zone,
    action_audi character(1),
    CONSTRAINT ck_admission_req CHECK (((admission_req)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying])::text[]))),
    CONSTRAINT ck_registration_req CHECK (((registration_req)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying])::text[]))),
    CONSTRAINT ck_state_req CHECK (((state_req)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying, 'P'::character varying, 'C'::character varying])::text[])))
);
 $   DROP TABLE simat_mass.audi_request;
    
   simat_mass         heap    postgres    false    14            7           1259    340486    audi_request_consecutivo_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.audi_request_consecutivo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE simat_mass.audi_request_consecutivo_seq;
    
   simat_mass          postgres    false    315    14            S           0    0    audi_request_consecutivo_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE simat_mass.audi_request_consecutivo_seq OWNED BY simat_mass.audi_request.consecutivo;
       
   simat_mass          postgres    false    311            9           1259    340488    audi_request_id_curr_req_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.audi_request_id_curr_req_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE simat_mass.audi_request_id_curr_req_seq;
    
   simat_mass          postgres    false    14    315            T           0    0    audi_request_id_curr_req_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE simat_mass.audi_request_id_curr_req_seq OWNED BY simat_mass.audi_request.id_curr_req;
       
   simat_mass          postgres    false    313            8           1259    340487    audi_request_id_req_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.audi_request_id_req_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE simat_mass.audi_request_id_req_seq;
    
   simat_mass          postgres    false    315    14            U           0    0    audi_request_id_req_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE simat_mass.audi_request_id_req_seq OWNED BY simat_mass.audi_request.id_req;
       
   simat_mass          postgres    false    312            :           1259    340489    audi_request_id_stud_req_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.audi_request_id_stud_req_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE simat_mass.audi_request_id_stud_req_seq;
    
   simat_mass          postgres    false    315    14            V           0    0    audi_request_id_stud_req_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE simat_mass.audi_request_id_stud_req_seq OWNED BY simat_mass.audi_request.id_stud_req;
       
   simat_mass          postgres    false    314            *           1259    340349    current    TABLE     7  CREATE TABLE simat_mass.current (
    id_curr integer NOT NULL,
    name_curr character varying(40),
    last_name_curr character varying(40),
    document_curr character varying(15),
    email_curr character varying(255),
    phone_curr character varying(20),
    id_doct_curr character varying(1),
    id_role_curr character varying(1) DEFAULT '3'::character varying,
    CONSTRAINT nn_last_name_curr CHECK ((last_name_curr IS NOT NULL)),
    CONSTRAINT nn_name_curr CHECK ((name_curr IS NOT NULL)),
    CONSTRAINT nn_phone_curr CHECK ((phone_curr IS NOT NULL))
);
    DROP TABLE simat_mass.current;
    
   simat_mass         heap    postgres    false    14            )           1259    340348    current_id_curr_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.current_id_curr_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE simat_mass.current_id_curr_seq;
    
   simat_mass          postgres    false    14    298            W           0    0    current_id_curr_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE simat_mass.current_id_curr_seq OWNED BY simat_mass.current.id_curr;
       
   simat_mass          postgres    false    297                       1259    271981    document_type    TABLE     �   CREATE TABLE simat_mass.document_type (
    id_doct character varying(1) NOT NULL,
    name_doct character varying(40),
    CONSTRAINT nn_name_doct CHECK ((name_doct IS NOT NULL))
);
 %   DROP TABLE simat_mass.document_type;
    
   simat_mass         heap    postgres    false    14                       1259    263423    grade    TABLE     �   CREATE TABLE simat_mass.grade (
    id_grade character varying(2) NOT NULL,
    name_grade character varying(15),
    CONSTRAINT nn_name_grade CHECK ((name_grade IS NOT NULL))
);
    DROP TABLE simat_mass.grade;
    
   simat_mass         heap    postgres    false    14                       1259    263707    hour    TABLE     �   CREATE TABLE simat_mass.hour (
    id_hour character varying(1) NOT NULL,
    name_hour character varying(20),
    CONSTRAINT nn_name_hour CHECK ((name_hour IS NOT NULL))
);
    DROP TABLE simat_mass.hour;
    
   simat_mass         heap    postgres    false    14            6           1259    340465 	   interview    TABLE     �  CREATE TABLE simat_mass.interview (
    id_inter integer NOT NULL,
    id_user_inter integer NOT NULL,
    id_sche_inter integer NOT NULL,
    state_inter character varying(1) DEFAULT 'P'::character varying,
    observation_inter character varying(40) DEFAULT 'Sin Observación'::character varying,
    CONSTRAINT ck_state_inter CHECK (((state_inter)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying, 'P'::character varying, 'C'::character varying])::text[])))
);
 !   DROP TABLE simat_mass.interview;
    
   simat_mass         heap    postgres    false    14            3           1259    340462    interview_id_inter_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.interview_id_inter_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE simat_mass.interview_id_inter_seq;
    
   simat_mass          postgres    false    14    310            X           0    0    interview_id_inter_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE simat_mass.interview_id_inter_seq OWNED BY simat_mass.interview.id_inter;
       
   simat_mass          postgres    false    307            5           1259    340464    interview_id_sche_inter_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.interview_id_sche_inter_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE simat_mass.interview_id_sche_inter_seq;
    
   simat_mass          postgres    false    14    310            Y           0    0    interview_id_sche_inter_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE simat_mass.interview_id_sche_inter_seq OWNED BY simat_mass.interview.id_sche_inter;
       
   simat_mass          postgres    false    309            4           1259    340463    interview_id_user_inter_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.interview_id_user_inter_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE simat_mass.interview_id_user_inter_seq;
    
   simat_mass          postgres    false    310    14            Z           0    0    interview_id_user_inter_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE simat_mass.interview_id_user_inter_seq OWNED BY simat_mass.interview.id_user_inter;
       
   simat_mass          postgres    false    308                       1259    280723    position    TABLE     �   CREATE TABLE simat_mass."position" (
    id_pos character varying(1) NOT NULL,
    name_pos character varying(40),
    CONSTRAINT nn_name_pos CHECK ((name_pos IS NOT NULL))
);
 "   DROP TABLE simat_mass."position";
    
   simat_mass         heap    postgres    false    14            0           1259    340402    request    TABLE     {  CREATE TABLE simat_mass.request (
    id_req integer NOT NULL,
    id_curr_req integer NOT NULL,
    id_stud_req integer NOT NULL,
    state_req character varying(1) DEFAULT 'P'::character varying,
    registration_req character varying(1) DEFAULT 'N'::character varying,
    admission_req character varying(1) DEFAULT 'N'::character varying,
    observation_req character varying(40) DEFAULT 'Sin Observación'::character varying,
    CONSTRAINT ck_admission_req CHECK (((admission_req)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying])::text[]))),
    CONSTRAINT ck_registration_req CHECK (((registration_req)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying])::text[]))),
    CONSTRAINT ck_state_req CHECK (((state_req)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying, 'P'::character varying, 'C'::character varying])::text[])))
);
    DROP TABLE simat_mass.request;
    
   simat_mass         heap    postgres    false    14            .           1259    340400    request_id_curr_req_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.request_id_curr_req_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE simat_mass.request_id_curr_req_seq;
    
   simat_mass          postgres    false    14    304            [           0    0    request_id_curr_req_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE simat_mass.request_id_curr_req_seq OWNED BY simat_mass.request.id_curr_req;
       
   simat_mass          postgres    false    302            -           1259    340399    request_id_req_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.request_id_req_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE simat_mass.request_id_req_seq;
    
   simat_mass          postgres    false    304    14            \           0    0    request_id_req_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE simat_mass.request_id_req_seq OWNED BY simat_mass.request.id_req;
       
   simat_mass          postgres    false    301            /           1259    340401    request_id_stud_req_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.request_id_stud_req_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE simat_mass.request_id_stud_req_seq;
    
   simat_mass          postgres    false    14    304            ]           0    0    request_id_stud_req_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE simat_mass.request_id_stud_req_seq OWNED BY simat_mass.request.id_stud_req;
       
   simat_mass          postgres    false    303            	           1259    263308    role    TABLE     �   CREATE TABLE simat_mass.role (
    id_role character varying(1) NOT NULL,
    name_role character varying(40),
    CONSTRAINT nn_name_role CHECK ((name_role IS NOT NULL))
);
    DROP TABLE simat_mass.role;
    
   simat_mass         heap    postgres    false    14            2           1259    340447    schedule    TABLE     �  CREATE TABLE simat_mass.schedule (
    id_sche integer NOT NULL,
    date_sche date,
    state_sche character varying(1) DEFAULT 'N'::character varying,
    id_hour_sche character varying(1),
    CONSTRAINT ck_state_sche CHECK (((state_sche)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying])::text[]))),
    CONSTRAINT nn_date_sche CHECK ((date_sche IS NOT NULL))
);
     DROP TABLE simat_mass.schedule;
    
   simat_mass         heap    postgres    false    14            1           1259    340446    schedule_id_sche_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.schedule_id_sche_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE simat_mass.schedule_id_sche_seq;
    
   simat_mass          postgres    false    306    14            ^           0    0    schedule_id_sche_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE simat_mass.schedule_id_sche_seq OWNED BY simat_mass.schedule.id_sche;
       
   simat_mass          postgres    false    305            ,           1259    340372    student    TABLE     �  CREATE TABLE simat_mass.student (
    id_stud integer NOT NULL,
    name_stud character varying(40),
    last_name_stud character varying(40),
    document_stud character varying(15),
    condition_stud character varying(1),
    condition_document_stud character varying(50),
    id_grade_stud character varying(2),
    id_doct_stud character varying(1),
    id_role_stud character varying(1) DEFAULT '4'::character varying,
    CONSTRAINT ck_condition_stud CHECK (((condition_stud)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying])::text[]))),
    CONSTRAINT nn_last_name_stud CHECK ((last_name_stud IS NOT NULL)),
    CONSTRAINT nn_name_stud CHECK ((name_stud IS NOT NULL))
);
    DROP TABLE simat_mass.student;
    
   simat_mass         heap    postgres    false    14            +           1259    340371    student_id_stud_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.student_id_stud_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE simat_mass.student_id_stud_seq;
    
   simat_mass          postgres    false    14    300            _           0    0    student_id_stud_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE simat_mass.student_id_stud_seq OWNED BY simat_mass.student.id_stud;
       
   simat_mass          postgres    false    299            (           1259    340319    user    TABLE       CREATE TABLE simat_mass."user" (
    id_user integer NOT NULL,
    name_user character varying(40),
    last_name_user character varying(40),
    document_user character varying(15),
    email_user character varying(20),
    state_user character varying(1),
    password_user character varying(40),
    id_pos_user character varying(1) DEFAULT '1'::character varying,
    id_doct_user character varying(1),
    id_role_user character varying(1),
    CONSTRAINT ck_state_user CHECK (((state_user)::text = ANY ((ARRAY['Y'::character varying, 'N'::character varying])::text[]))),
    CONSTRAINT nn_last_name_user CHECK ((last_name_user IS NOT NULL)),
    CONSTRAINT nn_name_user CHECK ((name_user IS NOT NULL)),
    CONSTRAINT nn_password_user CHECK ((password_user IS NOT NULL))
);
    DROP TABLE simat_mass."user";
    
   simat_mass         heap    postgres    false    14            '           1259    340318    user_id_user_seq    SEQUENCE     �   CREATE SEQUENCE simat_mass.user_id_user_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE simat_mass.user_id_user_seq;
    
   simat_mass          postgres    false    14    296            `           0    0    user_id_user_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE simat_mass.user_id_user_seq OWNED BY simat_mass."user".id_user;
       
   simat_mass          postgres    false    295            V           2604    340493    audi_request consecutivo    DEFAULT     �   ALTER TABLE ONLY simat_mass.audi_request ALTER COLUMN consecutivo SET DEFAULT nextval('simat_mass.audi_request_consecutivo_seq'::regclass);
 K   ALTER TABLE simat_mass.audi_request ALTER COLUMN consecutivo DROP DEFAULT;
    
   simat_mass          postgres    false    315    311    315            W           2604    340494    audi_request id_req    DEFAULT     �   ALTER TABLE ONLY simat_mass.audi_request ALTER COLUMN id_req SET DEFAULT nextval('simat_mass.audi_request_id_req_seq'::regclass);
 F   ALTER TABLE simat_mass.audi_request ALTER COLUMN id_req DROP DEFAULT;
    
   simat_mass          postgres    false    315    312    315            X           2604    340495    audi_request id_curr_req    DEFAULT     �   ALTER TABLE ONLY simat_mass.audi_request ALTER COLUMN id_curr_req SET DEFAULT nextval('simat_mass.audi_request_id_curr_req_seq'::regclass);
 K   ALTER TABLE simat_mass.audi_request ALTER COLUMN id_curr_req DROP DEFAULT;
    
   simat_mass          postgres    false    315    313    315            Y           2604    340496    audi_request id_stud_req    DEFAULT     �   ALTER TABLE ONLY simat_mass.audi_request ALTER COLUMN id_stud_req SET DEFAULT nextval('simat_mass.audi_request_id_stud_req_seq'::regclass);
 K   ALTER TABLE simat_mass.audi_request ALTER COLUMN id_stud_req DROP DEFAULT;
    
   simat_mass          postgres    false    314    315    315            D           2604    340352    current id_curr    DEFAULT     z   ALTER TABLE ONLY simat_mass.current ALTER COLUMN id_curr SET DEFAULT nextval('simat_mass.current_id_curr_seq'::regclass);
 B   ALTER TABLE simat_mass.current ALTER COLUMN id_curr DROP DEFAULT;
    
   simat_mass          postgres    false    297    298    298            Q           2604    340468    interview id_inter    DEFAULT     �   ALTER TABLE ONLY simat_mass.interview ALTER COLUMN id_inter SET DEFAULT nextval('simat_mass.interview_id_inter_seq'::regclass);
 E   ALTER TABLE simat_mass.interview ALTER COLUMN id_inter DROP DEFAULT;
    
   simat_mass          postgres    false    307    310    310            R           2604    340469    interview id_user_inter    DEFAULT     �   ALTER TABLE ONLY simat_mass.interview ALTER COLUMN id_user_inter SET DEFAULT nextval('simat_mass.interview_id_user_inter_seq'::regclass);
 J   ALTER TABLE simat_mass.interview ALTER COLUMN id_user_inter DROP DEFAULT;
    
   simat_mass          postgres    false    308    310    310            S           2604    340470    interview id_sche_inter    DEFAULT     �   ALTER TABLE ONLY simat_mass.interview ALTER COLUMN id_sche_inter SET DEFAULT nextval('simat_mass.interview_id_sche_inter_seq'::regclass);
 J   ALTER TABLE simat_mass.interview ALTER COLUMN id_sche_inter DROP DEFAULT;
    
   simat_mass          postgres    false    309    310    310            H           2604    340405    request id_req    DEFAULT     x   ALTER TABLE ONLY simat_mass.request ALTER COLUMN id_req SET DEFAULT nextval('simat_mass.request_id_req_seq'::regclass);
 A   ALTER TABLE simat_mass.request ALTER COLUMN id_req DROP DEFAULT;
    
   simat_mass          postgres    false    301    304    304            I           2604    340406    request id_curr_req    DEFAULT     �   ALTER TABLE ONLY simat_mass.request ALTER COLUMN id_curr_req SET DEFAULT nextval('simat_mass.request_id_curr_req_seq'::regclass);
 F   ALTER TABLE simat_mass.request ALTER COLUMN id_curr_req DROP DEFAULT;
    
   simat_mass          postgres    false    304    302    304            J           2604    340407    request id_stud_req    DEFAULT     �   ALTER TABLE ONLY simat_mass.request ALTER COLUMN id_stud_req SET DEFAULT nextval('simat_mass.request_id_stud_req_seq'::regclass);
 F   ALTER TABLE simat_mass.request ALTER COLUMN id_stud_req DROP DEFAULT;
    
   simat_mass          postgres    false    303    304    304            O           2604    340450    schedule id_sche    DEFAULT     |   ALTER TABLE ONLY simat_mass.schedule ALTER COLUMN id_sche SET DEFAULT nextval('simat_mass.schedule_id_sche_seq'::regclass);
 C   ALTER TABLE simat_mass.schedule ALTER COLUMN id_sche DROP DEFAULT;
    
   simat_mass          postgres    false    306    305    306            F           2604    340375    student id_stud    DEFAULT     z   ALTER TABLE ONLY simat_mass.student ALTER COLUMN id_stud SET DEFAULT nextval('simat_mass.student_id_stud_seq'::regclass);
 B   ALTER TABLE simat_mass.student ALTER COLUMN id_stud DROP DEFAULT;
    
   simat_mass          postgres    false    299    300    300            B           2604    340322    user id_user    DEFAULT     v   ALTER TABLE ONLY simat_mass."user" ALTER COLUMN id_user SET DEFAULT nextval('simat_mass.user_id_user_seq'::regclass);
 A   ALTER TABLE simat_mass."user" ALTER COLUMN id_user DROP DEFAULT;
    
   simat_mass          postgres    false    296    295    296            K          0    340490    audi_request 
   TABLE DATA           �   COPY simat_mass.audi_request (consecutivo, id_req, id_curr_req, id_stud_req, state_req, registration_req, admission_req, observation_req, register_date, action_audi) FROM stdin;
 
   simat_mass          postgres    false    315   c�       :          0    340349    current 
   TABLE DATA           �   COPY simat_mass.current (id_curr, name_curr, last_name_curr, document_curr, email_curr, phone_curr, id_doct_curr, id_role_curr) FROM stdin;
 
   simat_mass          postgres    false    298   ��       5          0    271981    document_type 
   TABLE DATA           ?   COPY simat_mass.document_type (id_doct, name_doct) FROM stdin;
 
   simat_mass          postgres    false    269   ��       3          0    263423    grade 
   TABLE DATA           9   COPY simat_mass.grade (id_grade, name_grade) FROM stdin;
 
   simat_mass          postgres    false    267    �       4          0    263707    hour 
   TABLE DATA           6   COPY simat_mass.hour (id_hour, name_hour) FROM stdin;
 
   simat_mass          postgres    false    268   ��       F          0    340465 	   interview 
   TABLE DATA           o   COPY simat_mass.interview (id_inter, id_user_inter, id_sche_inter, state_inter, observation_inter) FROM stdin;
 
   simat_mass          postgres    false    310   ��       6          0    280723    position 
   TABLE DATA           :   COPY simat_mass."position" (id_pos, name_pos) FROM stdin;
 
   simat_mass          postgres    false    284   �       @          0    340402    request 
   TABLE DATA           �   COPY simat_mass.request (id_req, id_curr_req, id_stud_req, state_req, registration_req, admission_req, observation_req) FROM stdin;
 
   simat_mass          postgres    false    304   ��       2          0    263308    role 
   TABLE DATA           6   COPY simat_mass.role (id_role, name_role) FROM stdin;
 
   simat_mass          postgres    false    265   ��       B          0    340447    schedule 
   TABLE DATA           T   COPY simat_mass.schedule (id_sche, date_sche, state_sche, id_hour_sche) FROM stdin;
 
   simat_mass          postgres    false    306   ��       <          0    340372    student 
   TABLE DATA           �   COPY simat_mass.student (id_stud, name_stud, last_name_stud, document_stud, condition_stud, condition_document_stud, id_grade_stud, id_doct_stud, id_role_stud) FROM stdin;
 
   simat_mass          postgres    false    300   �       8          0    340319    user 
   TABLE DATA           �   COPY simat_mass."user" (id_user, name_user, last_name_user, document_user, email_user, state_user, password_user, id_pos_user, id_doct_user, id_role_user) FROM stdin;
 
   simat_mass          postgres    false    296   7�       a           0    0    audi_request_consecutivo_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('simat_mass.audi_request_consecutivo_seq', 1, false);
       
   simat_mass          postgres    false    311            b           0    0    audi_request_id_curr_req_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('simat_mass.audi_request_id_curr_req_seq', 1, false);
       
   simat_mass          postgres    false    313            c           0    0    audi_request_id_req_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('simat_mass.audi_request_id_req_seq', 1, false);
       
   simat_mass          postgres    false    312            d           0    0    audi_request_id_stud_req_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('simat_mass.audi_request_id_stud_req_seq', 1, false);
       
   simat_mass          postgres    false    314            e           0    0    current_id_curr_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('simat_mass.current_id_curr_seq', 1, false);
       
   simat_mass          postgres    false    297            f           0    0    interview_id_inter_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('simat_mass.interview_id_inter_seq', 1, false);
       
   simat_mass          postgres    false    307            g           0    0    interview_id_sche_inter_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('simat_mass.interview_id_sche_inter_seq', 1, false);
       
   simat_mass          postgres    false    309            h           0    0    interview_id_user_inter_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('simat_mass.interview_id_user_inter_seq', 1, false);
       
   simat_mass          postgres    false    308            i           0    0    request_id_curr_req_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('simat_mass.request_id_curr_req_seq', 1, false);
       
   simat_mass          postgres    false    302            j           0    0    request_id_req_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('simat_mass.request_id_req_seq', 1, false);
       
   simat_mass          postgres    false    301            k           0    0    request_id_stud_req_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('simat_mass.request_id_stud_req_seq', 1, false);
       
   simat_mass          postgres    false    303            l           0    0    schedule_id_sche_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('simat_mass.schedule_id_sche_seq', 1, false);
       
   simat_mass          postgres    false    305            m           0    0    student_id_stud_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('simat_mass.student_id_stud_seq', 1, false);
       
   simat_mass          postgres    false    299            n           0    0    user_id_user_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('simat_mass.user_id_user_seq', 1, true);
       
   simat_mass          postgres    false    295            �           2606    340505    audi_request pk_audi_request 
   CONSTRAINT     g   ALTER TABLE ONLY simat_mass.audi_request
    ADD CONSTRAINT pk_audi_request PRIMARY KEY (consecutivo);
 J   ALTER TABLE ONLY simat_mass.audi_request DROP CONSTRAINT pk_audi_request;
    
   simat_mass            postgres    false    315            �           2606    340358    current pk_curr 
   CONSTRAINT     V   ALTER TABLE ONLY simat_mass.current
    ADD CONSTRAINT pk_curr PRIMARY KEY (id_curr);
 =   ALTER TABLE ONLY simat_mass.current DROP CONSTRAINT pk_curr;
    
   simat_mass            postgres    false    298            }           2606    271986    document_type pk_id_doct 
   CONSTRAINT     _   ALTER TABLE ONLY simat_mass.document_type
    ADD CONSTRAINT pk_id_doct PRIMARY KEY (id_doct);
 F   ALTER TABLE ONLY simat_mass.document_type DROP CONSTRAINT pk_id_doct;
    
   simat_mass            postgres    false    269            y           2606    263428    grade pk_id_grade 
   CONSTRAINT     Y   ALTER TABLE ONLY simat_mass.grade
    ADD CONSTRAINT pk_id_grade PRIMARY KEY (id_grade);
 ?   ALTER TABLE ONLY simat_mass.grade DROP CONSTRAINT pk_id_grade;
    
   simat_mass            postgres    false    267            {           2606    263712    hour pk_id_hour 
   CONSTRAINT     V   ALTER TABLE ONLY simat_mass.hour
    ADD CONSTRAINT pk_id_hour PRIMARY KEY (id_hour);
 =   ALTER TABLE ONLY simat_mass.hour DROP CONSTRAINT pk_id_hour;
    
   simat_mass            postgres    false    268                       2606    280728    position pk_id_pos 
   CONSTRAINT     Z   ALTER TABLE ONLY simat_mass."position"
    ADD CONSTRAINT pk_id_pos PRIMARY KEY (id_pos);
 B   ALTER TABLE ONLY simat_mass."position" DROP CONSTRAINT pk_id_pos;
    
   simat_mass            postgres    false    284            w           2606    263313    role pk_id_role 
   CONSTRAINT     V   ALTER TABLE ONLY simat_mass.role
    ADD CONSTRAINT pk_id_role PRIMARY KEY (id_role);
 =   ALTER TABLE ONLY simat_mass.role DROP CONSTRAINT pk_id_role;
    
   simat_mass            postgres    false    265            �           2606    340475    interview pk_inter 
   CONSTRAINT     x   ALTER TABLE ONLY simat_mass.interview
    ADD CONSTRAINT pk_inter PRIMARY KEY (id_inter, id_user_inter, id_sche_inter);
 @   ALTER TABLE ONLY simat_mass.interview DROP CONSTRAINT pk_inter;
    
   simat_mass            postgres    false    310    310    310            �           2606    340416    request pk_req 
   CONSTRAINT     n   ALTER TABLE ONLY simat_mass.request
    ADD CONSTRAINT pk_req PRIMARY KEY (id_req, id_curr_req, id_stud_req);
 <   ALTER TABLE ONLY simat_mass.request DROP CONSTRAINT pk_req;
    
   simat_mass            postgres    false    304    304    304            �           2606    340455    schedule pk_sche 
   CONSTRAINT     W   ALTER TABLE ONLY simat_mass.schedule
    ADD CONSTRAINT pk_sche PRIMARY KEY (id_sche);
 >   ALTER TABLE ONLY simat_mass.schedule DROP CONSTRAINT pk_sche;
    
   simat_mass            postgres    false    306            �           2606    340381    student pk_stud 
   CONSTRAINT     V   ALTER TABLE ONLY simat_mass.student
    ADD CONSTRAINT pk_stud PRIMARY KEY (id_stud);
 =   ALTER TABLE ONLY simat_mass.student DROP CONSTRAINT pk_stud;
    
   simat_mass            postgres    false    300            �           2606    340329    user pk_user 
   CONSTRAINT     U   ALTER TABLE ONLY simat_mass."user"
    ADD CONSTRAINT pk_user PRIMARY KEY (id_user);
 <   ALTER TABLE ONLY simat_mass."user" DROP CONSTRAINT pk_user;
    
   simat_mass            postgres    false    296            �           2606    340383    student uc_document_stud 
   CONSTRAINT     `   ALTER TABLE ONLY simat_mass.student
    ADD CONSTRAINT uc_document_stud UNIQUE (document_stud);
 F   ALTER TABLE ONLY simat_mass.student DROP CONSTRAINT uc_document_stud;
    
   simat_mass            postgres    false    300            �           2606    340360    current uc_email_curr 
   CONSTRAINT     Z   ALTER TABLE ONLY simat_mass.current
    ADD CONSTRAINT uc_email_curr UNIQUE (email_curr);
 C   ALTER TABLE ONLY simat_mass.current DROP CONSTRAINT uc_email_curr;
    
   simat_mass            postgres    false    298            �           2606    340331    user uc_email_user 
   CONSTRAINT     Y   ALTER TABLE ONLY simat_mass."user"
    ADD CONSTRAINT uc_email_user UNIQUE (email_user);
 B   ALTER TABLE ONLY simat_mass."user" DROP CONSTRAINT uc_email_user;
    
   simat_mass            postgres    false    296            �           2620    340516    request trg_audi_request    TRIGGER     �   CREATE TRIGGER trg_audi_request BEFORE DELETE OR UPDATE ON simat_mass.request FOR EACH ROW EXECUTE FUNCTION simat_mass.audi_request_fun();
 5   DROP TRIGGER trg_audi_request ON simat_mass.request;
    
   simat_mass          postgres    false    304    336            �           2606    340417    request fk_id_curr_req    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.request
    ADD CONSTRAINT fk_id_curr_req FOREIGN KEY (id_curr_req) REFERENCES simat_mass.current(id_curr);
 D   ALTER TABLE ONLY simat_mass.request DROP CONSTRAINT fk_id_curr_req;
    
   simat_mass          postgres    false    304    298    3461            �           2606    340506    audi_request fk_id_curr_req    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.audi_request
    ADD CONSTRAINT fk_id_curr_req FOREIGN KEY (id_curr_req) REFERENCES simat_mass.current(id_curr);
 I   ALTER TABLE ONLY simat_mass.audi_request DROP CONSTRAINT fk_id_curr_req;
    
   simat_mass          postgres    false    3461    298    315            �           2606    340361    current fk_id_doct_curr    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.current
    ADD CONSTRAINT fk_id_doct_curr FOREIGN KEY (id_doct_curr) REFERENCES simat_mass.document_type(id_doct);
 E   ALTER TABLE ONLY simat_mass.current DROP CONSTRAINT fk_id_doct_curr;
    
   simat_mass          postgres    false    269    3453    298            �           2606    340389    student fk_id_doct_stud    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.student
    ADD CONSTRAINT fk_id_doct_stud FOREIGN KEY (id_doct_stud) REFERENCES simat_mass.document_type(id_doct);
 E   ALTER TABLE ONLY simat_mass.student DROP CONSTRAINT fk_id_doct_stud;
    
   simat_mass          postgres    false    300    3453    269            �           2606    340337    user fk_id_doct_user    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass."user"
    ADD CONSTRAINT fk_id_doct_user FOREIGN KEY (id_doct_user) REFERENCES simat_mass.document_type(id_doct);
 D   ALTER TABLE ONLY simat_mass."user" DROP CONSTRAINT fk_id_doct_user;
    
   simat_mass          postgres    false    296    3453    269            �           2606    340384    student fk_id_grade_stud    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.student
    ADD CONSTRAINT fk_id_grade_stud FOREIGN KEY (id_grade_stud) REFERENCES simat_mass.grade(id_grade);
 F   ALTER TABLE ONLY simat_mass.student DROP CONSTRAINT fk_id_grade_stud;
    
   simat_mass          postgres    false    3449    267    300            �           2606    340456    schedule fk_id_hour_sche    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.schedule
    ADD CONSTRAINT fk_id_hour_sche FOREIGN KEY (id_hour_sche) REFERENCES simat_mass.hour(id_hour);
 F   ALTER TABLE ONLY simat_mass.schedule DROP CONSTRAINT fk_id_hour_sche;
    
   simat_mass          postgres    false    268    3451    306            �           2606    340332    user fk_id_pos_user    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass."user"
    ADD CONSTRAINT fk_id_pos_user FOREIGN KEY (id_pos_user) REFERENCES simat_mass."position"(id_pos);
 C   ALTER TABLE ONLY simat_mass."user" DROP CONSTRAINT fk_id_pos_user;
    
   simat_mass          postgres    false    284    296    3455            �           2606    340366    current fk_id_role_curr    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.current
    ADD CONSTRAINT fk_id_role_curr FOREIGN KEY (id_role_curr) REFERENCES simat_mass.role(id_role);
 E   ALTER TABLE ONLY simat_mass.current DROP CONSTRAINT fk_id_role_curr;
    
   simat_mass          postgres    false    298    265    3447            �           2606    340394    student fk_id_role_stud    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.student
    ADD CONSTRAINT fk_id_role_stud FOREIGN KEY (id_role_stud) REFERENCES simat_mass.role(id_role);
 E   ALTER TABLE ONLY simat_mass.student DROP CONSTRAINT fk_id_role_stud;
    
   simat_mass          postgres    false    300    3447    265            �           2606    340342    user fk_id_role_user    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass."user"
    ADD CONSTRAINT fk_id_role_user FOREIGN KEY (id_role_user) REFERENCES simat_mass.role(id_role);
 D   ALTER TABLE ONLY simat_mass."user" DROP CONSTRAINT fk_id_role_user;
    
   simat_mass          postgres    false    265    3447    296            �           2606    340481    interview fk_id_sche_inter    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.interview
    ADD CONSTRAINT fk_id_sche_inter FOREIGN KEY (id_sche_inter) REFERENCES simat_mass.schedule(id_sche);
 H   ALTER TABLE ONLY simat_mass.interview DROP CONSTRAINT fk_id_sche_inter;
    
   simat_mass          postgres    false    310    3471    306            �           2606    340422    request fk_id_stud_req    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.request
    ADD CONSTRAINT fk_id_stud_req FOREIGN KEY (id_stud_req) REFERENCES simat_mass.student(id_stud);
 D   ALTER TABLE ONLY simat_mass.request DROP CONSTRAINT fk_id_stud_req;
    
   simat_mass          postgres    false    3465    304    300            �           2606    340511    audi_request fk_id_stud_req    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.audi_request
    ADD CONSTRAINT fk_id_stud_req FOREIGN KEY (id_stud_req) REFERENCES simat_mass.student(id_stud);
 I   ALTER TABLE ONLY simat_mass.audi_request DROP CONSTRAINT fk_id_stud_req;
    
   simat_mass          postgres    false    300    315    3465            �           2606    340476    interview fk_id_user_inter    FK CONSTRAINT     �   ALTER TABLE ONLY simat_mass.interview
    ADD CONSTRAINT fk_id_user_inter FOREIGN KEY (id_user_inter) REFERENCES simat_mass."user"(id_user);
 H   ALTER TABLE ONLY simat_mass.interview DROP CONSTRAINT fk_id_user_inter;
    
   simat_mass          postgres    false    296    3457    310            K      x������ � �      :      x������ � �      5   S   x�3�I,JO-ITHIU�LI�+�LIL�2�t>�2�4,�Y
K�;�6��Yµ��(1/+�$c��X�X�_T������ ���      3   �   x�-�9�0�z�0ga���� BGc�2J�hb[\���#�bL���EA3>9�.X@���z�v?Tв��?�	k���q���5���ֱ��l��p��I��r{LP�{������:�J؇�HT�v|��\Ù�?\f��V�4L      4   K   x�-���0ѳ��4 r6�����;L�C���ލ��])7�r�;\9���7y�|������S~ψ� ܟ0      F      x������ � �      6   l   x����0 ��=E&@���ʗ��D�%#�a1F�b�~O��"{6R7�]���G)]�ʦ��b�Ox�R7� .D7�ą�g�ot�(iW�\��I|M1��ZD���%I      @      x������ � �      2   ?   x�3�tL����,.)JL�/�2�NM.J-I,�L�2�tL.M�L�+I�2�t-.rA�=... M �      B      x������ � �      <      x������ � �      8   F   x�3�N�+�LL��t�)K,J��4400��4�0��,NtH�M���K���r�J��99�8�b���� �     