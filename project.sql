PGDMP                          y            project    12.5    13.1 0    P           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            Q           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            R           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            S           1262    16835    project    DATABASE     k   CREATE DATABASE project WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.1252';
    DROP DATABASE project;
                postgres    false            ?            1259    16965    msbranch    TABLE     "  CREATE TABLE public.msbranch (
    branchid integer NOT NULL,
    branchname character varying(100) NOT NULL,
    cityid integer,
    createdby integer,
    createddate timestamp without time zone,
    updatedby integer,
    updateddate timestamp without time zone,
    isactive boolean
);
    DROP TABLE public.msbranch;
       public         heap    postgres    false            ?            1259    17198    msbranch_branchid_seq    SEQUENCE     ?   ALTER TABLE public.msbranch ALTER COLUMN branchid ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.msbranch_branchid_seq
    START WITH 8
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    209            ?            1259    16955    mscity    TABLE        CREATE TABLE public.mscity (
    cityid integer NOT NULL,
    cityname character varying(100) NOT NULL,
    provinceid integer,
    createdby integer,
    createddate timestamp without time zone,
    updatedby integer,
    updateddate timestamp without time zone,
    isactive boolean
);
    DROP TABLE public.mscity;
       public         heap    postgres    false            ?            1259    17196    mscity_cityid_seq    SEQUENCE     ?   ALTER TABLE public.mscity ALTER COLUMN cityid ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.mscity_cityid_seq
    START WITH 5
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    208            ?            1259    16940 	   mscountry    TABLE       CREATE TABLE public.mscountry (
    countryid integer NOT NULL,
    countryname character varying(50) NOT NULL,
    createdby integer,
    createddate timestamp without time zone,
    updatedby integer,
    updateddate timestamp without time zone,
    isactive boolean
);
    DROP TABLE public.mscountry;
       public         heap    postgres    false            ?            1259    17194    mscountry_countryid_seq    SEQUENCE     ?   ALTER TABLE public.mscountry ALTER COLUMN countryid ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.mscountry_countryid_seq
    START WITH 6
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    206            ?            1259    16926 
   mscustomer    TABLE     ?  CREATE TABLE public.mscustomer (
    customerid integer NOT NULL,
    customername text NOT NULL,
    customerprefix character varying(50),
    customerphone character varying,
    customeraddress text,
    customeremail character varying,
    customertypeid integer,
    customerprovinceid integer,
    customercityid integer,
    customersubdisid integer,
    customeruvid integer,
    customerpostalcode character varying,
    customerlatitude integer,
    customerlongtitude integer,
    createdby integer,
    createddate timestamp without time zone,
    updatedby integer,
    updateddate timestamp without time zone,
    isactive boolean
);
    DROP TABLE public.mscustomer;
       public         heap    postgres    false            ?            1259    17192    mscustomer_customerid_seq    SEQUENCE     ?   ALTER TABLE public.mscustomer ALTER COLUMN customerid ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.mscustomer_customerid_seq
    START WITH 6
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    204            ?            1259    16945 
   msprovince    TABLE     +  CREATE TABLE public.msprovince (
    provinceid integer NOT NULL,
    provincename character varying(100) NOT NULL,
    countryid integer,
    createdby integer,
    createddate timestamp without time zone,
    updatedby integer,
    updateddate timestamp without time zone,
    isactive boolean
);
    DROP TABLE public.msprovince;
       public         heap    postgres    false            ?            1259    17190    msprovince_provinceid_seq    SEQUENCE     ?   ALTER TABLE public.msprovince ALTER COLUMN provinceid ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.msprovince_provinceid_seq
    START WITH 8
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    207            ?            1259    16934    mstype    TABLE       CREATE TABLE public.mstype (
    typeid integer NOT NULL,
    typename character varying(100) NOT NULL,
    masterid integer,
    createdby integer,
    createddate timestamp without time zone,
    updatedby integer,
    updateddate timestamp without time zone,
    isactive boolean
);
    DROP TABLE public.mstype;
       public         heap    postgres    false            ?            1259    17188    mstype_typeid_seq    SEQUENCE     ?   ALTER TABLE public.mstype ALTER COLUMN typeid ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.mstype_typeid_seq
    START WITH 3
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    205            ?            1259    16862    msuser    TABLE     B  CREATE TABLE public.msuser (
    userid integer NOT NULL,
    username character varying(50) NOT NULL,
    userpassword text NOT NULL,
    createdby integer NOT NULL,
    createddate timestamp without time zone,
    updatedby integer NOT NULL,
    updateddate timestamp without time zone,
    isactive boolean NOT NULL
);
    DROP TABLE public.msuser;
       public         heap    postgres    false            ?            1259    16975    msuser_userid_seq    SEQUENCE     ?   ALTER TABLE public.msuser ALTER COLUMN userid ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.msuser_userid_seq
    START WITH 16
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    202            ?            1259    16870 	   msuserlog    TABLE     J  CREATE TABLE public.msuserlog (
    userlogid integer NOT NULL,
    userid integer NOT NULL,
    firstlogin timestamp without time zone,
    lastlogin timestamp without time zone,
    lastactive timestamp without time zone,
    activeduration interval,
    lastlocation text,
    lastpasswordchange timestamp without time zone
);
    DROP TABLE public.msuserlog;
       public         heap    postgres    false            ?            1259    17066    msuserlog_userlogid_seq    SEQUENCE     ?   ALTER TABLE public.msuserlog ALTER COLUMN userlogid ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.msuserlog_userlogid_seq
    START WITH 5
    INCREMENT BY 1
    MINVALUE 5
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    203            E          0    16965    msbranch 
   TABLE DATA           z   COPY public.msbranch (branchid, branchname, cityid, createdby, createddate, updatedby, updateddate, isactive) FROM stdin;
    public          postgres    false    209   7>       D          0    16955    mscity 
   TABLE DATA           x   COPY public.mscity (cityid, cityname, provinceid, createdby, createddate, updatedby, updateddate, isactive) FROM stdin;
    public          postgres    false    208   ?>       B          0    16940 	   mscountry 
   TABLE DATA           u   COPY public.mscountry (countryid, countryname, createdby, createddate, updatedby, updateddate, isactive) FROM stdin;
    public          postgres    false    206   SA       @          0    16926 
   mscustomer 
   TABLE DATA           E  COPY public.mscustomer (customerid, customername, customerprefix, customerphone, customeraddress, customeremail, customertypeid, customerprovinceid, customercityid, customersubdisid, customeruvid, customerpostalcode, customerlatitude, customerlongtitude, createdby, createddate, updatedby, updateddate, isactive) FROM stdin;
    public          postgres    false    204   ?A       C          0    16945 
   msprovince 
   TABLE DATA           ?   COPY public.msprovince (provinceid, provincename, countryid, createdby, createddate, updatedby, updateddate, isactive) FROM stdin;
    public          postgres    false    207   ?B       A          0    16934    mstype 
   TABLE DATA           v   COPY public.mstype (typeid, typename, masterid, createdby, createddate, updatedby, updateddate, isactive) FROM stdin;
    public          postgres    false    205   FC       >          0    16862    msuser 
   TABLE DATA           z   COPY public.msuser (userid, username, userpassword, createdby, createddate, updatedby, updateddate, isactive) FROM stdin;
    public          postgres    false    202   rC       ?          0    16870 	   msuserlog 
   TABLE DATA           ?   COPY public.msuserlog (userlogid, userid, firstlogin, lastlogin, lastactive, activeduration, lastlocation, lastpasswordchange) FROM stdin;
    public          postgres    false    203   ?D       T           0    0    msbranch_branchid_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.msbranch_branchid_seq', 8, false);
          public          postgres    false    217            U           0    0    mscity_cityid_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.mscity_cityid_seq', 43, true);
          public          postgres    false    216            V           0    0    mscountry_countryid_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.mscountry_countryid_seq', 6, true);
          public          postgres    false    215            W           0    0    mscustomer_customerid_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.mscustomer_customerid_seq', 14, true);
          public          postgres    false    214            X           0    0    msprovince_provinceid_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.msprovince_provinceid_seq', 8, true);
          public          postgres    false    213            Y           0    0    mstype_typeid_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.mstype_typeid_seq', 3, false);
          public          postgres    false    212            Z           0    0    msuser_userid_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.msuser_userid_seq', 21, true);
          public          postgres    false    210            [           0    0    msuserlog_userlogid_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.msuserlog_userlogid_seq', 15, true);
          public          postgres    false    211            ?
           2606    16969    msbranch msbranch_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.msbranch
    ADD CONSTRAINT msbranch_pkey PRIMARY KEY (branchid);
 @   ALTER TABLE ONLY public.msbranch DROP CONSTRAINT msbranch_pkey;
       public            postgres    false    209            ?
           2606    16959    mscity mscity_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.mscity
    ADD CONSTRAINT mscity_pkey PRIMARY KEY (cityid);
 <   ALTER TABLE ONLY public.mscity DROP CONSTRAINT mscity_pkey;
       public            postgres    false    208            ?
           2606    16944    mscountry mscountry_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.mscountry
    ADD CONSTRAINT mscountry_pkey PRIMARY KEY (countryid);
 B   ALTER TABLE ONLY public.mscountry DROP CONSTRAINT mscountry_pkey;
       public            postgres    false    206            ?
           2606    16933    mscustomer mscustomer_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.mscustomer
    ADD CONSTRAINT mscustomer_pkey PRIMARY KEY (customerid);
 D   ALTER TABLE ONLY public.mscustomer DROP CONSTRAINT mscustomer_pkey;
       public            postgres    false    204            ?
           2606    16949    msprovince msprovince_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.msprovince
    ADD CONSTRAINT msprovince_pkey PRIMARY KEY (provinceid);
 D   ALTER TABLE ONLY public.msprovince DROP CONSTRAINT msprovince_pkey;
       public            postgres    false    207            ?
           2606    16938    mstype mstype_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.mstype
    ADD CONSTRAINT mstype_pkey PRIMARY KEY (typeid);
 <   ALTER TABLE ONLY public.mstype DROP CONSTRAINT mstype_pkey;
       public            postgres    false    205            ?
           2606    16869    msuser msuser_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.msuser
    ADD CONSTRAINT msuser_pkey PRIMARY KEY (userid);
 <   ALTER TABLE ONLY public.msuser DROP CONSTRAINT msuser_pkey;
       public            postgres    false    202            ?
           2606    16877    msuserlog msuserlog_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.msuserlog
    ADD CONSTRAINT msuserlog_pkey PRIMARY KEY (userlogid);
 B   ALTER TABLE ONLY public.msuserlog DROP CONSTRAINT msuserlog_pkey;
       public            postgres    false    203            ?
           2606    16970    msbranch msbranch_cityid_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.msbranch
    ADD CONSTRAINT msbranch_cityid_fkey FOREIGN KEY (cityid) REFERENCES public.mscity(cityid);
 G   ALTER TABLE ONLY public.msbranch DROP CONSTRAINT msbranch_cityid_fkey;
       public          postgres    false    208    209    2745            ?
           2606    16960    mscity mscity_provinceid_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.mscity
    ADD CONSTRAINT mscity_provinceid_fkey FOREIGN KEY (provinceid) REFERENCES public.msprovince(provinceid);
 G   ALTER TABLE ONLY public.mscity DROP CONSTRAINT mscity_provinceid_fkey;
       public          postgres    false    2743    207    208            ?
           2606    16950 $   msprovince msprovince_countryid_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.msprovince
    ADD CONSTRAINT msprovince_countryid_fkey FOREIGN KEY (countryid) REFERENCES public.mscountry(countryid);
 N   ALTER TABLE ONLY public.msprovince DROP CONSTRAINT msprovince_countryid_fkey;
       public          postgres    false    2741    207    206            ?
           2606    16878    msuserlog msuserlog_userid_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.msuserlog
    ADD CONSTRAINT msuserlog_userid_fkey FOREIGN KEY (userid) REFERENCES public.msuser(userid);
 I   ALTER TABLE ONLY public.msuserlog DROP CONSTRAINT msuserlog_userid_fkey;
       public          postgres    false    2733    202    203            E   C   x?3?tt?4???CF\F?NN?F??Ɯ?Μ???&?..?jM9]]1?5?ts?4???ݝ?]4F??? &[ j      D   ?  x?uU?r?0<C_?H? I=x̱????S?rZ?jd9i????cӠ}[a	K`?qs>???>?`?1P? I????i{?s<? ?????\pB?c%??`??8???,?,|??? ?3?9??1??_S??z%[???)???M???6?e6S{??y?5x?>??M i??6.??3wUǗ????X?ۣ?BN???4Ls??\V??]`????˹>đ?^?67?v??&# ??s|???Y?%???;Z{????9??؛,?5?4Ϲ????JfZ'??P?X???ß?-?<(??@????<?????Й?D?wa:=?+?̴??Z?????????ͪ$?`?zx????m???y?bH?"?Lla^?E-?C???Rv?,i?Ѻ|?????O??V)??z^?U)I6Wf&±.dT??UJKP/ǺP??3???B??ثL?6 	??j`??3?c,????????eWK??n;?^?M? ֬ 3???????$!(?Bczq?????:׆???)e?7<,??i?5?Ҷ-??l?r?d???1?1?Fî??y?\????T&{???s?ey???k6֮??l??N6;?m?V???ӳ???^p??r????y?q>/%](??????	?}??<i??i?=??v}?<??(??????S??N:?\??e|?^C
?????????????q?e      B   z   x?3?t?M-??N?42 "#C]c]Cs+#3+\?%\F??y)?y?ř??5???/J%]?	?WjAb^:?M??MO/?,&F??????????9P??cF?@TXX`
?32j????? ??F?      @   ?   x????
?0???S?:???iO??Ru?mU/???7c???$???K?????4??T]?????'l?[S}y? ?i?>d?Zy?N9Iێ?:?H6!??Ҹ??dg?vؐ?̱"s?	?
9?10?^??!?6?JϾ?k?}PҗK????E?b??Na?Z?f??oT??Ƙ7?Y      C   ?   x?3??J,OTpJ,J,?4?42 "#C]c]Cs+#3+\?%\F?!?y???F$?7??N?I,I??4&? ?2sK?Ȱ??D????;7)??p3?????N?L??ĩ
?f??Ҝ????L?o?`hje`aed?K??+F??? (h?      A      x?3?t4???CC\F??FX?c???? ?
{      >   '  x?u??n?@ E??W?p?0?8?,?iA[Q;?FThx???ƦiJrWgqO??k?L?0?hZm|髲???kT?$???G???kڶlBg?????;}??? D??bLz??B??<>ߝţy?p????B?a??Xp?4?Ѳ"?$}[????vBݣ????N???mL???D??=[`&LF<`#\V1?ʨ?_r???_V??ǽ?4??gln2Bo??"+????C?2~?m????|???m??|h^??Ԟ?^???yt??;&?n)b#?Uޡ?(߂u?      ?   ?   x?????0E??+?E??݇gfV?JT??ѩO???H???sm#L?%??*?`A,ah=?Be??~???????a????8߇[?_???i?j???H>ܘr?Z?mlXSO?t??D]C?{b??$? ??9??&??q?"w?~??ʤ?Ym?z+c????6????9?"Jg;     