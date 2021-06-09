<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    // ! Ini data santri

    $app->get("/santri/", function (Request $request, Response $response) { 
        $sql = "SELECT * FROM santri"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/santri/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "SELECT * FROM santri WHERE id_santri=:id"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([":id" => $id]); 
        $result = $stmt->fetch(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/santri/search/", function (Request $request, Response $response, $args) { 
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM santri WHERE nama_santri LIKE '%$keyword%' OR alamat_santri LIKE '%$keyword%' OR kelas LIKE '%$keyword%'"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->post("/santri/", function (Request $request, Response $response) { 
        $new_book = $request->getParsedBody(); 
        $sql = "INSERT INTO santri (nama_santri, alamat_santri, kelas, jns_kelamin_santri) VALUE (:nama_santri, :alamat_santri, :kelas, :jns_kelamin_santri)"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":nama_santri" => $new_book["nama_santri"], 
            ":alamat_santri" => $new_book["alamat_santri"], 
            ":kelas" => $new_book["kelas"], 
            ":jns_kelamin_santri" => $new_book["jns_kelamin_santri"] 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->put("/santri/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $new_santri = $request->getParsedBody(); 
        $sql = "UPDATE santri SET nama_santri=:nama_santri, alamat_santri=:alamat_santri, kelas=:kelas, jns_kelamin_santri=:jns_kelamin_santri WHERE id_santri=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id, 
            ":nama_santri" => $new_santri["nama_santri"], 
            ":alamat_santri" => $new_santri["alamat_santri"], 
            ":kelas" => $new_santri["kelas"], 
            ":jns_kelamin_santri" => $new_santri["jns_kelamin_santri"]  
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->delete("/santri/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "DELETE FROM santri WHERE id_santri=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });


    // ! Ini data pengawas

    $app->get("/pengawas/", function (Request $request, Response $response) { 
        $sql = "SELECT * FROM pengawas"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/pengawas/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "SELECT * FROM pengawas WHERE id_pengawas=:id"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([":id" => $id]); 
        $result = $stmt->fetch(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/pengawas/search/", function (Request $request, Response $response, $args) { 
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM pengawas WHERE nama_pengawas LIKE '%$keyword%' OR jabatan LIKE '%$keyword%' OR alamat_pengawas LIKE '%$keyword%' OR jns_kelamin_pengawas LIKE '%$keyword%'"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->post("/pengawas/", function (Request $request, Response $response) { 
        $new_pengawas = $request->getParsedBody(); 
        $sql = "INSERT INTO pengawas (nama_pengawas, jabatan, alamat_pengawas, jns_kelamin_pengawas) VALUE (:nama_pengawas, :jabatan, :alamat_pengawas, :jns_kelamin_pengawas)"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":nama_pengawas" => $new_pengawas["nama_pengawas"], 
            ":jabatan" => $new_pengawas["jabatan"], 
            ":alamat_pengawas" => $new_pengawas["alamat_pengawas"], 
            ":jns_kelamin_pengawas" => $new_pengawas["jns_kelamin_pengawas"] 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->put("/pengawas/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $new_pengawas = $request->getParsedBody(); 
        $sql = "UPDATE pengawas SET nama_pengawas=:nama_pengawas, jabatan=:jabatan, alamat_pengawas=:alamat_pengawas, jns_kelamin_pengawas=:jns_kelamin_pengawas WHERE id_pengawas=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id, 
            ":nama_pengawas" => $new_pengawas["nama_pengawas"], 
            ":jabatan" => $new_pengawas["jabatan"], 
            ":alamat_pengawas" => $new_pengawas["alamat_pengawas"], 
            ":jns_kelamin_pengawas" => $new_pengawas["jns_kelamin_pengawas"]  
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->delete("/pengawas/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "DELETE FROM pengawas WHERE id_pengawas=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    //! Ini data pengajar
    
    $app->get("/pengajar/", function (Request $request, Response $response) { 
        $sql = "SELECT * FROM pengajar"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/pengajar/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "SELECT * FROM pengajar WHERE id_pengajar=:id"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([":id" => $id]); 
        $result = $stmt->fetch(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/pengajar/search/", function (Request $request, Response $response, $args) { 
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM pengajar WHERE nama_pengajar LIKE '%$keyword%' OR alamat_pengajar LIKE '%$keyword%' OR jns_kelamin_pengajar LIKE '%$keyword%'"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->post("/pengajar/", function (Request $request, Response $response) { 
        $new_pengajar = $request->getParsedBody(); 
        $sql = "INSERT INTO pengajar (nama_pengajar, alamat_pengajar, jns_kelamin_pengajar) VALUE (:nama_pengajar, :alamat_pengajar, :jns_kelamin_pengajar)"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":nama_pengajar" => $new_pengajar["nama_pengajar"],
            ":alamat_pengajar" => $new_pengajar["alamat_pengajar"], 
            ":jns_kelamin_pengajar" => $new_pengajar["jns_kelamin_pengajar"] 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->put("/pengajar/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $new_pengajar = $request->getParsedBody(); 
        $sql = "UPDATE pengajar SET nama_pengajar=:nama_pengajar, alamat_pengajar=:alamat_pengajar, jns_kelamin_pengajar=:jns_kelamin_pengajar WHERE id_pengajar=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id, 
            ":nama_pengajar" => $new_pengajar["nama_pengajar"],
            ":alamat_pengajar" => $new_pengajar["alamat_pengajar"], 
            ":jns_kelamin_pengajar" => $new_pengajar["jns_kelamin_pengajar"]  
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->delete("/pengajar/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "DELETE FROM pengajar WHERE id_pengajar=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    // ! Ini pembelajaran
    $app->get("/pembelajaran/", function (Request $request, Response $response) { 
        $sql = "SELECT * FROM pembelajaran"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/pembelajaran/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "SELECT * FROM pembelajaran WHERE id_pembelajaran=:id"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([":id" => $id]); 
        $result = $stmt->fetch(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/pembelajaran/search/", function (Request $request, Response $response, $args) { 
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM pembelajaran WHERE id_santri LIKE '%$keyword%' OR id_pengajar LIKE '%$keyword%' OR id_pengawas LIKE '%$keyword%'"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->post("/pembelajaran/", function (Request $request, Response $response) { 
        $new_pembelajaran = $request->getParsedBody(); 
        $sql = "INSERT INTO pembelajaran (id_santri, id_pengajar, id_pengawas, id_mata_pembelajaran, id_kegiatan_tambahan, nilai) VALUE (:id_santri, :id_pengajar, :id_pengawas, :id_mata_pembelajaran, :id_kegiatan_tambahan, :nilai)"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id_santri" => $new_pembelajaran["id_santri"],
            ":id_pengajar" => $new_pembelajaran["id_pengajar"], 
            ":id_pengawas" => $new_pembelajaran["id_pengawas"], 
            ":id_mata_pembelajaran" => $new_pembelajaran["id_mata_pembelajaran"], 
            ":id_kegiatan_tambahan" => $new_pembelajaran["id_kegiatan_tambahan"], 
            ":nilai" => $new_pembelajaran["nilai"]    
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->put("/pembelajaran/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $new_pembelajaran = $request->getParsedBody(); 
        $sql = "UPDATE pembelajaran SET id_santri=:id_santri, id_pengajar=:id_pengajar, id_pengawas=:id_pengawas, id_mata_pembelajaran=:id_mata_pembelajaran, id_kegiatan_tambahan=:id_kegiatan_tambahan, nilai=:nilai WHERE id_pembelajaran=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id, 
            ":id_santri" => $new_pembelajaran["id_santri"],
            ":id_pengajar" => $new_pembelajaran["id_pengajar"], 
            ":id_pengawas" => $new_pembelajaran["id_pengawas"], 
            ":id_mata_pembelajaran" => $new_pembelajaran["id_mata_pembelajaran"], 
            ":id_kegiatan_tambahan" => $new_pembelajaran["id_kegiatan_tambahan"], 
            ":nilai" => $new_pembelajaran["nilai"]     
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->delete("/pembelajaran/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "DELETE FROM pembelajaran WHERE id_pembelajaran=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    // ! Ini ada mata pembelajaran
    $app->get("/matapembelajaran/", function (Request $request, Response $response) { 
        $sql = "SELECT * FROM mata_pembelajaran"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/matapembelajaran/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "SELECT * FROM mata_pembelajaran WHERE id_mata_pembelajaran=:id"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([":id" => $id]); 
        $result = $stmt->fetch(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/matapembelajaran/search/", function (Request $request, Response $response, $args) { 
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM mata_pembelajaran WHERE kode_pembelajaran LIKE '%$keyword%' OR nama_pembelajaran LIKE '%$keyword%' OR sks LIKE '%$keyword%'"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->post("/matapembelajaran/", function (Request $request, Response $response) { 
        $new_mata_pembelajaran = $request->getParsedBody(); 
        $sql = "INSERT INTO mata_pembelajaran (kode_pembelajaran, nama_pembelajaran, sks) VALUE (:kode_pembelajaran, :nama_pembelajaran, :sks)"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":kode_pembelajaran" => $new_mata_pembelajaran["kode_pembelajaran"],
            ":nama_pembelajaran" => $new_mata_pembelajaran["nama_pembelajaran"], 
            ":sks" => $new_mata_pembelajaran["sks"] 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->put("/matapembelajaran/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $new_mata_pembelajaran = $request->getParsedBody(); 
        $sql = "UPDATE mata_pembelajaran SET kode_pembelajaran=:kode_pembelajaran, nama_pembelajaran=:nama_pembelajaran, sks=:sks WHERE id_mata_pembelajaran=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id, 
            ":kode_pembelajaran" => $new_mata_pembelajaran["kode_pembelajaran"],
            ":nama_pembelajaran" => $new_mata_pembelajaran["nama_pembelajaran"], 
            ":sks" => $new_mata_pembelajaran["sks"]  
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->delete("/matapembelajaran/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "DELETE FROM mata_pembelajaran WHERE id_mata_pembelajaran=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    // ! Ini data kegiatan tambahan
    $app->get("/kegiatantambahan/", function (Request $request, Response $response) { 
        $sql = "SELECT * FROM kegiatan_tambahan"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/kegiatantambahan/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "SELECT * FROM kegiatan_tambahan WHERE id_kegiatan_tambahan=:id"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([":id" => $id]); 
        $result = $stmt->fetch(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->get("/kegiatantambahan/search/", function (Request $request, Response $response, $args) { 
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM kegiatan_tambahan WHERE nama_kegiatan LIKE '%$keyword%' OR lokasi_kegiatan LIKE '%$keyword%'"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(); 
        return $response->withJson(["status" => "success", "data" => $result], 200); 
    });

    $app->post("/kegiatantambahan/", function (Request $request, Response $response) { 
        $new_kegiatan_tambahan = $request->getParsedBody(); 
        $sql = "INSERT INTO kegiatan_tambahan (nama_kegiatan, lokasi_kegiatan) VALUE (:nama_kegiatan, :lokasi_kegiatan)"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":nama_kegiatan" => $new_kegiatan_tambahan["nama_kegiatan"],
            ":lokasi_kegiatan" => $new_kegiatan_tambahan["lokasi_kegiatan"]
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->put("/kegiatantambahan/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $new_kegiatan_tambahan = $request->getParsedBody(); 
        $sql = "UPDATE kegiatan_tambahan SET nama_kegiatan=:nama_kegiatan, lokasi_kegiatan=:lokasi_kegiatan WHERE id_kegiatan_tambahan=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id, 
            ":nama_kegiatan" => $new_kegiatan_tambahan["nama_kegiatan"],
            ":lokasi_kegiatan" => $new_kegiatan_tambahan["lokasi_kegiatan"]
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200); 
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

    $app->delete("/kegiatantambahan/{id}", function (Request $request, Response $response, $args) { 
        $id = $args["id"]; 
        $sql = "DELETE FROM kegiatan_tambahan WHERE id_kegiatan_tambahan=:id"; 
        $stmt = $this->db->prepare($sql); 
        
        $data = [ 
            ":id" => $id 
        ];

        if($stmt->execute($data)) 
        return $response->withJson(["status" => "success", "data" => "1"], 200);
        return $response->withJson(["status" => "failed", "data" => "0"], 200); 
    });

};
